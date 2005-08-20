<?php
//   -------------------------------------------------------------------------------
//  |             VHCS(tm) - Virtual Hosting Control System                         |
//  |              Copyright (c) 2001-2005 by moleSoftware		            		|
//  |			http://vhcs.net | http://www.molesoftware.com		           		|
//  |                                                                               |
//  | This program is free software; you can redistribute it and/or                 |
//  | modify it under the terms of the MPL General Public License                   |
//  | as published by the Free Software Foundation; either version 1.1              |
//  | of the License, or (at your option) any later version.                        |
//  |                                                                               |
//  | You should have received a copy of the MPL Mozilla Public License             |
//  | along with this program; if not, write to the Free Software                   |
//  | Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA     |
//  |                                                                               |
//   -------------------------------------------------------------------------------



/* BEGIN common functions */
function find_program ($program)
{
    $path = array(
                    '/bin',
                    '/sbin',
                    '/usr/bin',
                    '/usr/sbin',
                    '/usr/local/bin',
                    '/usr/local/sbin'
                 );

    while ($this_path = current($path)) {

        if (is_file("$this_path/$program")) {
            return "$this_path/$program";
        }

        next($path);
    }

    return;

}


function execute_program ($program, $args = '')
{

    $buffer = '';

   /*
    $program = find_program($program);

    print "$program $args<hr>";

    if (!$program) { return; }

    if ($args) {
        $args_list = split(' ', $args);
        for ($i = 0; $i < count($args_list); $i++) {
            if ($args_list[$i] == '|') {
                $cmd = $args_list[$i+1];
                $new_cmd = find_program($cmd);
                $args = ereg_replace("\| $cmd", "| $new_cmd", $args);
            }
        }
    }
    */

    if ($fp = popen("/bin/df $args", 'r')) {
        while (!feof($fp)) {
            $buffer .= fgets($fp, 4096);
        }
        return trim($buffer);
    }
}


function compat_array_keys ($arr)
{
        $result = array();

        while (list($key, $val) = each($arr)) {
            $result[] = $key;
        }
        return $result;
}

function compat_in_array ($value, $arr)
{
    while (list($key,$val) = each($arr)) {
        if ($value == $val) {
            return true;
        }
    }
    return false;
}


function format_bytesize ($kbytes, $dec_places = 2)
{
    global $text;
    if ($kbytes > 1048576) {
        $result  = sprintf('%.' . $dec_places . 'f', $kbytes / 1048576);
        $result .= '&nbsp;'.'GB';
    } elseif ($kbytes > 1024) {
        $result  = sprintf('%.' . $dec_places . 'f', $kbytes / 1024);
        $result .= '&nbsp;'.'MB';
    } else {
        $result  = sprintf('%.' . $dec_places . 'f', $kbytes);
        $result .= '&nbsp;'.'KB';
    }
    return $result;
}
/* END common functions */



/* BEGIN system functions */
    function kernel ()
    {
        if ($fd = fopen('/proc/version', 'r'))
        {
            $buf = fgets($fd, 4096);
            fclose($fd);

            if (preg_match('/version (.*?) /', $buf, $ar_buf)) {
                $result = $ar_buf[1];

                if (preg_match('/SMP/', $buf)) {
                    $result .= ' (SMP)';
                }
            } else {
                $result = 'N.A.';
            }
        } else {
            $result = 'N.A.';
        }
        return $result;
    }

    function uptime ()
    {
        global $text;
        $fd = fopen('/proc/uptime', 'r');
        $ar_buf = split(' ', fgets($fd, 4096));
        fclose($fd);

        $sys_ticks = trim($ar_buf[0]);

        $min   = $sys_ticks / 60;
        $hours = $min / 60;
        $days  = floor($hours / 24);
        $hours = floor($hours - ($days * 24));
        $min   = floor($min - ($days * 60 * 24) - ($hours * 60));

        $result = '';
        
        if ($days != 0) {
            $result = "$days "." days ";
        }

        if ($hours != 0) {
            $result .= "$hours "." hours ";
        }
        $result .= "$min "."minutes ";

        return $result;
    }

    function loadavg ()
    {
        if ($fd = fopen('/proc/loadavg', 'r')) {
            $results = split(' ', fgets($fd, 4096));
            fclose($fd);
        } else {
            $results = array('N.A.','N.A.','N.A.');
        } 
        return $results;
    }


    function cpu_info ()
    {
        $results = array();
        $ar_buf = array();
        $results['bogomips'] = 0;

//        if ($fd = fopen('/proc/cpuinfo', 'r')) {
 //           while ($buf = fgets($fd, 4096)) {
         $cpuinfo = file('/proc/cpuinfo');

// Loop through our array, show HTML source as HTML source; and line numbers too.
        foreach ($cpuinfo as $line_num => $line) {
//            list($key, $value) = preg_split('/\s+:\s+/', trim($buf), 2);
            if(trim($line)!= ''){
            list($key, $value) = preg_split('/\s+:\s+/', trim($line), 2);

                switch ($key) {
                    case 'model name':
                        $results['model'] = $value;
                        break;
                    case 'cpu MHz':
                        $results['mhz'] = sprintf('%.2f', $value);
                        break;
                    case 'clock': /* For PPC arch (damn borked POS) */
                        $results['mhz'] = sprintf('%.2f', $value);
                        break;
                    case 'cpu': /* For PPC arch (damn borked POS) */
                        $results['model'] = $value;
                        break;
                    case 'revision': /* For PPC arch (damn borked POS) */
                        $results['model'] .= ' ( rev: ' . $value . ')';
                        break;
                    case 'cache size':
                        $results['cache'] = $value;
                        break;
                    case 'bogomips':
                        $results['bogomips'] += $value;
                        break;
                }
            }
//            fclose($fd);
        }

        $keys = compat_array_keys($results);
        $keys2be = array('model', 'mhz', 'cache', 'bogomips', 'cpus');

        while ($ar_buf = each($keys2be)) {
            if (! compat_in_array($ar_buf[1], $keys)) {
                $results[$ar_buf[1]] = 'N.A.';
            }
        }
        return $results;

    }

    function memory ()
    {
	
	global $results;
        if ($fd = fopen('/proc/meminfo', 'r')) {
            while ($buf = fgets($fd, 4096)) {
                if (preg_match('/Mem:\s+(.*)$/', $buf, $ar_buf)) {
                    $ar_buf = preg_split('/\s+/', $ar_buf[1], 6);

                    $results['ram'] = array();

                    $results['ram']['total']   = $ar_buf[0] / 1024;
                    $results['ram']['used']    = $ar_buf[1] / 1024;
                    $results['ram']['free']    = $ar_buf[2] / 1024;
                    $results['ram']['shared']  = $ar_buf[3] / 1024;
                    $results['ram']['buffers'] = $ar_buf[4] / 1024;
                    $results['ram']['cached']  = $ar_buf[5] / 1024;

                    $results['ram']['t_used']  = $results['ram']['used'] - $results['ram']['cached'] - $results['ram']['buffers'];
                    $results['ram']['t_free']  = $results['ram']['total'] - $results['ram']['t_used'];
                    $results['ram']['percent'] = round(($results['ram']['t_used'] * 100) / $results['ram']['total']);
                }

                if (preg_match('/Swap:\s+(.*)$/', $buf, $ar_buf)) {
                    $ar_buf = preg_split('/\s+/', $ar_buf[1], 3);

                    $results['swap'] = array();

                    $results['swap']['total']   = $ar_buf[0] / 1024;
                    $results['swap']['used']    = $ar_buf[1] / 1024;
                    $results['swap']['free']    = $ar_buf[2] / 1024;
                    $results['swap']['percent'] = round(($ar_buf[1] * 100) / $ar_buf[0]);

                    /* Get info on individual swap files */
//                    $swaps = file ('/proc/swaps');
// file is array                    
                    $swapdevs = file ('/proc/swaps');
//                    $swapdevs = split("\n", $swaps);

                    for ($i = 1; $i < (sizeof($swapdevs) - 1); $i++) {
                        $ar_buf = preg_split('/\s+/', $swapdevs[$i], 6);

                        $results['devswap'][$i - 1] = array();
                        $results['devswap'][$i - 1]['dev']     = $ar_buf[0];
                        $results['devswap'][$i - 1]['total']   = $ar_buf[2];
                        $results['devswap'][$i - 1]['used']    = $ar_buf[3];
                        $results['devswap'][$i - 1]['free']    = ($results['devswap'][$i - 1]['total'] - $results['devswap'][$i - 1]['used']);
                        $results['devswap'][$i - 1]['percent'] = round(($ar_buf[3] * 100) / $ar_buf[2]);
                    }
                    break;
                }
            }
            fclose($fd);
        } else {
		
			
            
			$results['ram'] = array();
            $results['swap'] = array();
            $results['devswap'] = array();
        }
        return $results;
    }


    function filesystems ()
    {
        $results = array();

        $df = execute_program('df', '-kP');

        $mounts = split("\n", $df);
        $fstype = array();

        if ($fd = fopen('/proc/mounts', 'r')) {
            while ($buf = fgets($fd, 4096)) {
                list($dev, $mpoint, $type) = preg_split('/\s+/', trim($buf), 4);
                $fstype[$mpoint] = $type;
                $fsdev[$dev] = $type;
            }
            fclose($fd);
        }
        for ($i = 1; $i < sizeof($mounts); $i++) {
            $ar_buf = preg_split('/\s+/', $mounts[$i], 6);

            $results[$i - 1] = array();

            $results[$i - 1]['disk'] = $ar_buf[0];
            $results[$i - 1]['size'] = $ar_buf[1];
            $results[$i - 1]['used'] = $ar_buf[2];
            $results[$i - 1]['free'] = $ar_buf[3];
            $results[$i - 1]['percent'] = round(($results[$i - 1]['used'] * 100) / $results[$i - 1]['size']) . '%';
            $results[$i - 1]['mount'] = $ar_buf[5];
            ($fstype[$ar_buf[5]]) ? $results[$i - 1]['fstype'] = $fstype[$ar_buf[5]] : $results[$i - 1]['fstype'] = $fsdev[$ar_buf[0]];
        }
        return $results;
    }

/* END system functions */

include '../include/vhcs-lib.php';

check_login();

$tpl = new pTemplate();

$tpl -> define_dynamic('page', $cfg['ADMIN_TEMPLATE_PATH'].'/sysinfo.tpl');

$tpl -> define_dynamic('page_message', 'page');

$tpl -> define_dynamic('disk_list', 'page');

$tpl -> define_dynamic('disk_list_item', 'disk_list');

global $cfg;
$theme_color = $cfg['USER_INITIAL_THEME'];

$tpl -> assign(
                array(
                        'TR_ADMIN_CHANGE_PASSWORD_PAGE_TITLE' => tr('VHCS - Circular'),
                        'THEME_COLOR_PATH' => "../themes/$theme_color",
                        'THEME_CHARSET' => tr('encoding'),
                        'ISP_LOGO' => get_logo($_SESSION['user_id']),
                        'VHCS_LICENSE' => $cfg['VHCS_LICENSE']
                     )
              );

              
function gen_mount_point(&$tpl)
{
    $mount_points = filesystems();
    
    while (list($number, $row) = each($mount_points)) {
        
     if (($number+1) % 2 == 0) {
        $tpl -> assign(
                array(
                    'ITEM_CLASS' => 'content', 
                    )
                );
    }
    else{
        $tpl -> assign(
                array(
                    'ITEM_CLASS' => 'content2', 
                    )
                );      
    }
       $tpl -> assign(
                array(
                        'MOUNT' => $row['mount'],
                        'TYPE' => $row['fstype'],
                        'PARTITION' => $row['disk'],
                        'PERCENT' => $row['percent'],
                        'FREE' => make_hr($row['free']*1014),
                        'USED' => make_hr($row['used']*1024),
                        'SIZE' => make_hr($row['size']*1024),
                     )
              );
              
          $tpl -> parse('DISK_LIST_ITEM', '.disk_list_item');
     }

    $tpl -> parse('DISK_LIST', 'disk_list');
}

/*
 *
 * static page messages.
 *
 */

gen_admin_menu($tpl);

gen_mount_point($tpl);

$kernel = kernel();
$uptime = uptime();
$load = loadavg();
$cpu = cpu_info();
$mem = memory();

$tpl -> assign(
        array(
                'TR_SYSTEM_INFO_TITLE' => tr('System info'),
                'TR_SYSTEM_INFO' => tr('Vital system info'),
                'TR_CPU_SYSTEM_INFO' => tr('CPU system Info'),
                'TR_CPU_MODEL' => tr('CPU model'),
                'TR_CPU_MHZ' => tr('CPU MHz'),
                'TR_CPU_CACHE' => tr('CPU cache'),
                'TR_CPU_BOGOMIPS' => tr('CPU bogomips'),
                'CPU_MODEL' => $cpu['model'],
                'CPU_MHZ' => $cpu['mhz'],
                'CPU_CACHE' => $cpu['cache'],
                'CPU_BOGOMIPS' => $cpu['bogomips'],
                'TR_MEMRY_SYSTEM_INFO' => tr('Memory system info'),
                'TR_RAM' => tr('RAM'),
                'TR_TOTAL' => tr('Total'),
                'TR_USED' => tr('Used'),
                'TR_FREE' => tr('Free'),
                'TR_SWAP' => tr('Swap'),
                'TR_UPTIME' => tr('Up time'),
                'UPTIME' => $uptime,
                'TR_KERNEL' => tr('Kernel'),
                'KERNEL' => $kernel,
                'TR_LOAD' => tr('Load'),
                'LOAD' => $load[0] . ' ' . $load[1] . '  '. $load[0] ,
                'RAM' => tr('RAM'),
                'RAM_TOTAL' => format_bytesize($mem['ram']['total']),
                'RAM_USED' => format_bytesize($mem['ram']['used']),
                'RAM_FREE' => format_bytesize($mem['ram']['free']),
                'SWAP_TOTAL' => format_bytesize($mem['swap']['total']),
                'SWAP_USED' => format_bytesize($mem['swap']['used']),
                'SWAP_FREE' => format_bytesize($mem['swap']['free']),
                'TR_FILE_SYSTEM_INFO' => tr('Filesystem system Info'),
                'TR_MOUNT' => tr('Mount'),
                'TR_TYPE' => tr('Type'),
                'TR_PARTITION' => tr('Partition'),
                'TR_PERCENT' => tr('Percent'),
                'TR_SIZE' => tr('Size')
                )
        );

gen_page_message($tpl);

$tpl -> parse('PAGE', 'page');

$tpl -> prnt();

if (isset($cfg['DUMP_GUI_DEBUG'])) dump_gui_debug();

unset_messages();

?>
