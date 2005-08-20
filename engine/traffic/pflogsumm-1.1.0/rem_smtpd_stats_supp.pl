#!/usr/bin/perl -w
eval 'exec perl -S $0 "$@"'
    if 0;
#
# rem_smtpd_stats_supp.pl - Remove smtpd stats support from pflogsumm.pl
#
# This script will remove the smtpd stats support from pflogsumm.pl so
# if you don't have Date::Calc and don't want to bother installing it,
# pflogsumm will still run.
#
# Of course: you won't be able to generate smtpd stats, then.
#
# Usage: rem_smtpd_stats_supp.pl
#
# Assumes pflogsumm.pl exists in the current directory.  Will rename
# the distribution version to "pflogsumm.pl-with_smtpd_stats" and
# name the stripped version "pflogsumm.pl"

use strict;

my $origFile = "pflogsumm.pl";
my $tempFile = "pflogsumm.tmp";
my $saveFile = "pflogsumm.pl-with_smtpd_stats";

my $fileChanged = 0;

open(ORIG, "< $origFile") ||
    die "Couldn't open \"$origFile\" for reading: $!\n";

open(TMP, "> $tempFile") ||
    die "Couldn't open \"$tempFile\" for writing: $!\n";

OUTER: while(<ORIG>) {
    if(/^# ---Begin: SMTPD_STATS_SUPPORT---$/o) {
	++$fileChanged;
	while(<ORIG>) {
	    if(/^# ---Begin: SMTPD_STATS_SUPPORT---$/o) {
		# Should never see this here!
		$fileChanged = 1;	# Make uneven
		last OUTER;
	    } elsif(/^# ---End: SMTPD_STATS_SUPPORT---$/o) {
		++$fileChanged;
		next OUTER;
	    }
	}
	# If we get here, we ran out of input.  Shouldn't happen!
	last OUTER;
    } elsif(/^# ---End: SMTPD_STATS_SUPPORT---$/o) {
	# Should never see this here!
	$fileChanged = 1;	# Make uneven
	last OUTER;
    } else {
	print TMP;
    }
}

close(ORIG) ||
    warn "May have been problem reading \"$origFile\": $!\n";

close(TMP) ||
    die "Problem writing \"$tempFile\": $!\n";

if($fileChanged && $fileChanged % 2 == 0) {
    print "Renaming original $origFile to $saveFile...\n";
    rename("$origFile", "$saveFile") ||
	die "Problem attempting to rename \"$origFile\" to \"$saveFile\": $!\n";
    print "Renaming temp file to $origFile...\n";
    rename("$tempFile", "$origFile") ||
	die "Problem attempting to rename \"$tempFile\" to \"$origFile\": $!\n";
} else {
    if($fileChanged) {
	print "Unbalanced delimiters in \"$origFile\": cannot continue\n";
    } else {
	print "No change! ($origFile already processed?)\n";
    }
    print "Removing temp file...\n";
    unlink($tempFile) ||
	warn "Problem removing \"$tempFile\"?: $!\n";
}
