<?php
/* $Id: select_lang.lib.php,v 2.23 2005/06/11 10:23:21 lem9 Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:


/**
 * phpMyAdmin Language Loading File
 */


/**
 * We need some elements of the superglobal $_SERVER array.
 */
require_once('./libraries/grab_globals.lib.php');


/**
 * Define the path to the translations directory and get some variables
 * from system arrays if 'register_globals' is set to 'off'
 */
$lang_path = 'lang/';


/**
 * All the supported languages have to be listed in the array below.
 * 1. The key must be the "official" ISO 639 language code and, if required,
 *    the dialect code. It can also contain some informations about the
 *    charset (see the Russian case).
 * 2. The first of the values associated to the key is used in a regular
 *    expression to find some keywords corresponding to the language inside two
 *    environment variables.
 *    These values contains:
 *    - the "official" ISO language code and, if required, the dialect code
 *      also ('bu' for Bulgarian, 'fr([-_][[:alpha:]]{2})?' for all French
 *      dialects, 'zh[-_]tw' for Chinese traditional...), the dialect has to 
 *      be specified as first;
 *    - the '|' character (it means 'OR');
 *    - the full language name.
 * 3. The second values associated to the key is the name of the file to load
 *    without the 'inc.php' extension.
 * 4. The last values associated to the key is the language code as defined by
 *    the RFC1766.
 *
 * Beware that the sorting order (first values associated to keys by
 * alphabetical reverse order in the array) is important: 'zh-tw' (chinese
 * traditional) must be detected before 'zh' (chinese simplified) for
 * example.
 *
 * When there are more than one charset for a language, we put the -utf-8
 * last because we need the default charset to be non-utf-8 to avoid
 * problems on MySQL < 4.1.x if AllowAnywhereRecoding is FALSE.
 *
 * For Russian, we put 1251 first, because MSIE does not accept 866
 * and users would not see anything.
 */
$available_languages = array(
    'af-iso-8859-1'     => array('af|afrikaans', 'afrikaans-iso-8859-1', 'af'),
    'af-utf-8'          => array('af|afrikaans', 'afrikaans-utf-8', 'af'),
    'ar-win1256'        => array('ar|arabic', 'arabic-windows-1256', 'ar'),
    'ar-utf-8'          => array('ar|arabic', 'arabic-utf-8', 'ar'),
    'az-iso-8859-9'     => array('az|azerbaijani', 'azerbaijani-iso-8859-9', 'az'),
    'az-utf-8'          => array('az|azerbaijani', 'azerbaijani-utf-8', 'az'),

    'becyr-win1251'     => array('be|belarusian', 'belarusian_cyrillic-windows-1251', 'be'),
    'becyr-utf-8'       => array('be|belarusian', 'belarusian_cyrillic-utf-8', 'be'),
    'belat-utf-8'       => array('be[-_]lat|belarusian latin', 'belarusian_latin-utf-8', 'be-lat'),
    'bg-win1251'        => array('bg|bulgarian', 'bulgarian-windows-1251', 'bg'),
    'bg-koi8-r'         => array('bg|bulgarian', 'bulgarian-koi8-r', 'bg'),
    'bg-utf-8'          => array('bg|bulgarian', 'bulgarian-utf-8', 'bg'),
    'bs-win1250'        => array('bs|bosnian', 'bosnian-windows-1250', 'bs'),
    'bs-utf-8'          => array('bs|bosnian', 'bosnian-utf-8', 'bs'),
    'ca-iso-8859-1'     => array('ca|catalan', 'catalan-iso-8859-1', 'ca'),
    'ca-utf-8'          => array('ca|catalan', 'catalan-utf-8', 'ca'),
    'cs-iso-8859-2'     => array('cs|czech', 'czech-iso-8859-2', 'cs'),
    'cs-win1250'        => array('cs|czech', 'czech-windows-1250', 'cs'),
    'cs-utf-8'          => array('cs|czech', 'czech-utf-8', 'cs'),
    'da-iso-8859-1'     => array('da|danish', 'danish-iso-8859-1', 'da'),
    'da-utf-8'          => array('da|danish', 'danish-utf-8', 'da'),
    'de-iso-8859-1'     => array('de|german', 'german-iso-8859-1', 'de'),
    'de-iso-8859-15'    => array('de|german', 'german-iso-8859-15', 'de'),
    'de-utf-8'          => array('de|german', 'german-utf-8', 'de'),
    'el-iso-8859-7'     => array('el|greek',  'greek-iso-8859-7', 'el'),
    'el-utf-8'          => array('el|greek',  'greek-utf-8', 'el'),
    'en-iso-8859-1'     => array('en|english',  'english-iso-8859-1', 'en'),
    'en-iso-8859-15'    => array('en|english',  'english-iso-8859-15', 'en'),
    'en-utf-8'          => array('en|english',  'english-utf-8', 'en'),
    'es-iso-8859-1'     => array('es|spanish', 'spanish-iso-8859-1', 'es'),
    'es-iso-8859-15'    => array('es|spanish', 'spanish-iso-8859-15', 'es'),
    'es-utf-8'          => array('es|spanish', 'spanish-utf-8', 'es'),
    'et-iso-8859-1'     => array('et|estonian', 'estonian-iso-8859-1', 'et'),
    'et-utf-8'          => array('et|estonian', 'estonian-utf-8', 'et'),
    'eu-iso-8859-1'     => array('eu|basque', 'basque-iso-8859-1', 'eu'),
    'eu-utf-8'          => array('eu|basque', 'basque-utf-8', 'eu'),
    'fa-win1256'        => array('fa|persian', 'persian-windows-1256', 'fa'),
    'fa-utf-8'          => array('fa|persian', 'persian-utf-8', 'fa'),
    'fi-iso-8859-1'     => array('fi|finnish', 'finnish-iso-8859-1', 'fi'),
    'fi-iso-8859-15'    => array('fi|finnish', 'finnish-iso-8859-15', 'fi'),
    'fi-utf-8'          => array('fi|finnish', 'finnish-utf-8', 'fi'),
    'fr-iso-8859-1'     => array('fr|french', 'french-iso-8859-1', 'fr'),
    'fr-iso-8859-15'    => array('fr|french', 'french-iso-8859-15', 'fr'),
    'fr-utf-8'          => array('fr|french', 'french-utf-8', 'fr'),
    'gl-iso-8859-1'     => array('gl|galician', 'galician-iso-8859-1', 'gl'),
    'gl-utf-8'          => array('gl|galician', 'galician-utf-8', 'gl'),
    'he-iso-8859-8-i'   => array('he|hebrew', 'hebrew-iso-8859-8-i', 'he'),
    'he-utf-8'          => array('he|hebrew', 'hebrew-utf-8', 'he'),
    'hi-utf-8'          => array('hi|hindi', 'hindi-utf-8', 'hi'),
    'hr-win1250'        => array('hr|croatian', 'croatian-windows-1250', 'hr'),
    'hr-iso-8859-2'     => array('hr|croatian', 'croatian-iso-8859-2', 'hr'),
    'hr-utf-8'          => array('hr|croatian', 'croatian-utf-8', 'hr'),
    'hu-iso-8859-2'     => array('hu|hungarian', 'hungarian-iso-8859-2', 'hu'),
    'hu-utf-8'          => array('hu|hungarian', 'hungarian-utf-8', 'hu'),
    'id-iso-8859-1'     => array('id|indonesian', 'indonesian-iso-8859-1', 'id'),
    'id-utf-8'          => array('id|indonesian', 'indonesian-utf-8', 'id'),
    'it-iso-8859-1'     => array('it|italian', 'italian-iso-8859-1', 'it'),
    'it-iso-8859-15'    => array('it|italian', 'italian-iso-8859-15', 'it'),
    'it-utf-8'          => array('it|italian', 'italian-utf-8', 'it'),
    'ja-euc'            => array('ja|japanese', 'japanese-euc', 'ja'),
    'ja-sjis'           => array('ja|japanese', 'japanese-sjis', 'ja'),
    'ja-utf-8'          => array('ja|japanese', 'japanese-utf-8', 'ja'),
    'ko-euc-kr'         => array('ko|korean', 'korean-euc-kr', 'ko'),
    'ko-utf-8'          => array('ko|korean', 'korean-utf-8', 'ko'),
    'ka-utf-8'          => array('ka|georgian', 'georgian-utf-8', 'ka'),
    'lt-win1257'        => array('lt|lithuanian', 'lithuanian-windows-1257', 'lt'),
    'lt-utf-8'          => array('lt|lithuanian', 'lithuanian-utf-8', 'lt'),
    'lv-win1257'        => array('lv|latvian', 'latvian-windows-1257', 'lv'),
    'lv-utf-8'          => array('lv|latvian', 'latvian-utf-8', 'lv'),
    'mn-utf-8'          => array('mn|mongolian', 'mongolian-utf-8', 'mn'),
    'ms-iso-8859-1'     => array('ms|malay', 'malay-iso-8859-1', 'ms'),
    'ms-utf-8'          => array('ms|malay', 'malay-utf-8', 'ms'),
    'nl-iso-8859-1'     => array('nl|dutch', 'dutch-iso-8859-1', 'nl'),
    'nl-iso-8859-15'    => array('nl|dutch', 'dutch-iso-8859-15', 'nl'),
    'nl-utf-8'          => array('nl|dutch', 'dutch-utf-8', 'nl'),
    'no-iso-8859-1'     => array('no|norwegian', 'norwegian-iso-8859-1', 'no'),
    'no-utf-8'          => array('no|norwegian', 'norwegian-utf-8', 'no'),
    'pl-iso-8859-2'     => array('pl|polish', 'polish-iso-8859-2', 'pl'),
    'pl-win1250'        => array('pl|polish', 'polish-windows-1250', 'pl'),
    'pl-utf-8'          => array('pl|polish', 'polish-utf-8', 'pl'),
    'ptbr-iso-8859-1'   => array('pt[-_]br|brazilian portuguese', 'brazilian_portuguese-iso-8859-1', 'pt-BR'),
    'ptbr-utf-8'        => array('pt[-_]br|brazilian portuguese', 'brazilian_portuguese-utf-8', 'pt-BR'),
    'pt-iso-8859-1'     => array('pt|portuguese', 'portuguese-iso-8859-1', 'pt'),
    'pt-iso-8859-15'    => array('pt|portuguese', 'portuguese-iso-8859-15', 'pt'),
    'pt-utf-8'          => array('pt|portuguese', 'portuguese-utf-8', 'pt'),
    'ro-iso-8859-1'     => array('ro|romanian', 'romanian-iso-8859-1', 'ro'),
    'ro-utf-8'          => array('ro|romanian', 'romanian-utf-8', 'ro'),
    'ru-win1251'        => array('ru|russian', 'russian-windows-1251', 'ru'),
    'ru-cp-866'         => array('ru|russian', 'russian-cp-866', 'ru'),
    'ru-koi8-r'         => array('ru|russian', 'russian-koi8-r', 'ru'),
    'ru-utf-8'          => array('ru|russian', 'russian-utf-8', 'ru'),
    'sk-iso-8859-2'     => array('sk|slovak', 'slovak-iso-8859-2', 'sk'),
    'sk-win1250'        => array('sk|slovak', 'slovak-windows-1250', 'sk'),
    'sk-utf-8'          => array('sk|slovak', 'slovak-utf-8', 'sk'),
    'sl-iso-8859-2'     => array('sl|slovenian', 'slovenian-iso-8859-2', 'sl'),
    'sl-win1250'        => array('sl|slovenian', 'slovenian-windows-1250', 'sl'),
    'sl-utf-8'          => array('sl|slovenian', 'slovenian-utf-8', 'sl'),
    'sq-iso-8859-1'     => array('sq|albanian', 'albanian-iso-8859-1', 'sq'),
    'sq-utf-8'          => array('sq|albanian', 'albanian-utf-8', 'sq'),
    'srlat-win1250'     => array('sr[-_]lat|serbian latin', 'serbian_latin-windows-1250', 'sr-lat'),
    'srlat-utf-8'       => array('sr[-_]lat|serbian latin', 'serbian_latin-utf-8', 'sr-lat'),
    'srcyr-win1251'     => array('sr|serbian', 'serbian_cyrillic-windows-1251', 'sr'),
    'srcyr-utf-8'       => array('sr|serbian', 'serbian_cyrillic-utf-8', 'sr'),
    'sv-iso-8859-1'     => array('sv|swedish', 'swedish-iso-8859-1', 'sv'),
    'sv-utf-8'          => array('sv|swedish', 'swedish-utf-8', 'sv'),
    'th-tis-620'        => array('th|thai', 'thai-tis-620', 'th'),
    'th-utf-8'          => array('th|thai', 'thai-utf-8', 'th'),
    'tr-iso-8859-9'     => array('tr|turkish', 'turkish-iso-8859-9', 'tr'),
    'tr-utf-8'          => array('tr|turkish', 'turkish-utf-8', 'tr'),
    'tt-iso-8859-9'     => array('tt|tatarish', 'tatarish-iso-8859-9', 'tt'),
    'tt-utf-8'          => array('tt|tatarish', 'tatarish-utf-8', 'tt'),
    'uk-win1251'        => array('uk|ukrainian', 'ukrainian-windows-1251', 'uk'),
    'uk-utf-8'          => array('uk|ukrainian', 'ukrainian-utf-8', 'uk'),
    'zhtw-big5'         => array('zh[-_](tw|hk)|chinese traditional', 'chinese_traditional-big5', 'zh-TW'),
    'zhtw-utf-8'        => array('zh[-_](tw|hk)|chinese traditional', 'chinese_traditional-utf-8', 'zh-TW'),
    'zh-gb2312'         => array('zh|chinese simplified', 'chinese_simplified-gb2312', 'zh'),
    'zh-utf-8'          => array('zh|chinese simplified', 'chinese_simplified-utf-8', 'zh')
);


/**
 * Analyzes some PHP environment variables to find the most probable language
 * that should be used
 *
 * @param   string   string to analyze
 * @param   integer  type of the PHP environment variable which value is $str
 *
 * @global  array    the list of available translations
 * @global  string   the retained translation keyword
 *
 * @access  private
 */
function PMA_langDetect($str = '', $envType = '')
{
    global $available_languages;
    global $lang;

    foreach ($available_languages AS $key => $value) {
        // $envType =  1 for the 'HTTP_ACCEPT_LANGUAGE' environment variable,
        //             2 for the 'HTTP_USER_AGENT' one
        $expr = $value[0];
        if (strpos($expr, '[-_]') === FALSE) {
            $expr = str_replace('|', '([-_][[:alpha:]]{2,3})?|', $expr);
        }
        if (($envType == 1 && eregi('^(' . $expr . ')(;q=[0-9]\\.[0-9])?$', $str))
            || ($envType == 2 && eregi('(\(|\[|;[[:space:]])(' . $expr . ')(;|\]|\))', $str))) {
            $lang     = $key;
            break;
        }
    }
} // end of the 'PMA_langDetect()' function


if (!isset($lang)) {
    if (isset($_GET) && !empty($_GET['lang'])) {
        $lang = $_GET['lang'];
    }
    else if (isset($_POST) && !empty($_POST['lang'])) {
        $lang = $_POST['lang'];
    }
    else if (isset($_COOKIE) && !empty($_COOKIE['pma_lang'])) {
        $lang = $_COOKIE['pma_lang'];
    }
}


/**
 * Do the work!
 */

// compatibility with config.inc.php <= v1.80
if (!isset($cfg['Lang']) && isset($cfgLang)) {
    $cfg['Lang']        = $cfgLang;
    unset($cfgLang);
}
if (!isset($cfg['DefaultLang']) && isset($cfgDefaultLang)) {
    $cfg['DefaultLang'] = $cfgDefaultLang;
    unset($cfgLang);
}

// MySQL charsets map
$mysql_charset_map = array(
    'big5'         => 'big5',
    'cp-866'       => 'cp866',
    'euc-jp'       => 'ujis',
    'euc-kr'       => 'euckr',
    'gb2312'       => 'gb2312',
    'gbk'          => 'gbk',
    'iso-8859-1'   => 'latin1',
    'iso-8859-2'   => 'latin2',
    'iso-8859-7'   => 'greek',
    'iso-8859-8'   => 'hebrew',
    'iso-8859-8-i' => 'hebrew',
    'iso-8859-9'   => 'latin5',
    'iso-8859-13'  => 'latin7',
    'iso-8859-15'  => 'latin1',
    'koi8-r'       => 'koi8r',
    'shift_jis'    => 'sjis',
    'tis-620'      => 'tis620',
    'utf-8'        => 'utf8',
    'windows-1250' => 'cp1250',
    'windows-1251' => 'cp1251',
    'windows-1252' => 'latin1',
    'windows-1256' => 'cp1256',
    'windows-1257' => 'cp1257',
);

// Lang forced
if (!empty($cfg['Lang'])) {
    $lang = $cfg['Lang'];
}

// If '$lang' is defined, ensure this is a valid translation
if (!empty($lang) && empty($available_languages[$lang])) {
    $lang = '';
}

// Language is not defined yet :
// 1. try to findout user's language by checking its HTTP_ACCEPT_LANGUAGE
//    variable
if (empty($lang) && !empty($HTTP_ACCEPT_LANGUAGE)) {
    $accepted    = explode(',', $HTTP_ACCEPT_LANGUAGE);
    $acceptedCnt = count($accepted);
    for ($i = 0; $i < $acceptedCnt && empty($lang); $i++) {
        PMA_langDetect($accepted[$i], 1);
    }
}
// 2. try to findout user's language by checking its HTTP_USER_AGENT variable
if (empty($lang) && !empty($HTTP_USER_AGENT)) {
    PMA_langDetect($HTTP_USER_AGENT, 2);
}

// 3. Didn't catch any valid lang : we use the default settings
if (empty($lang)) {
    $lang = $cfg['DefaultLang'];
}

// 4. Checks whether charset recoding should be allowed or not
$allow_recoding = FALSE; // Default fallback value
if (!isset($convcharset) || empty($convcharset)) {
    if (isset($_COOKIE['pma_charset'])) {
        $convcharset = $_COOKIE['pma_charset'];
    } else {
        $convcharset = $cfg['DefaultCharset'];
    }
}

// 5. Defines the associated filename and load the translation
$lang_file = $lang_path . $available_languages[$lang][1] . '.inc.php';
require_once('./' . $lang_file);
?>
