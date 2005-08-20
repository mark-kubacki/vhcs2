#!/usr/bin/perl

use strict;
use warnings;

die ("Undefined Input Data!") if (!defined($ARGV[0]) || !defined($ARGV[1]));

my ($php_fname, $perl_fname) = ($ARGV[0], $ARGV[1]);
my @keys;
my ($key, $iv);

# get keys data;
system("./gen-keys 32 8 > keys.txt");
open(F, '<', 'keys.txt');
@keys = <F>;
close(F);
($key, $iv) = ($keys[0], $keys[1]);

# we do not want \ in our encryption key;
while ($key =~ /\\/ || $iv =~ /\\/) {
	chop($key);
	chop($iv);
	print("not good pair ($key, $iv). generating new...\n");sleep(1);
	system("./gen-keys 32 8 > keys.txt");
	open(F, '<', 'keys.txt');
	@keys = <F>;
	close(F);
	($key, $iv) = ($keys[0], $keys[1]);
}


$key =~ s/'/\\'/gi;
$iv =~ s/'/\\'/gi;

# remove \n at the end of lines;

chop($key);
chop($iv);

# do the durty work;


# php lib;

open(F, '<', $php_fname);
my @php_file = <F>;
close(F);

$php_file[4] = "\t\$vhcs2_db_pass_key = '$key';\n";
$php_file[8] = "\t\$vhcs2_db_pass_iv = '$iv';\n";

open(F, '>', $php_fname);
foreach(@php_file) {
	
	syswrite(F, $_);
	
}
close(F);

# perl lib;

open(F, '<', $perl_fname);
my @perl_file = <F>;
close(F);

$perl_file[1] = "\$main::db_pass_key = '$key';\n";
$perl_file[3] = "\$main::db_pass_iv = '$iv';\n";

open(F, '>', $perl_fname);
foreach(@perl_file) {
	
	syswrite(F, $_);
	
}
close(F);
