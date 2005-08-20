#ifndef _SIGNAL_HANDLERS_H

#define _SIGNAL_HANDLERS_H

#include <sys/types.h>

#include <sys/wait.h>

#include <stdlib.h>

#include <stdio.h>

#include <string.h>

#define MSG_SIG_CHLD            10005

#define MSG_SIG_PIPE            10006

extern void say(char *format, char *message);

extern char *message(int message_number);

void sig_child (int signo);

void sig_pipe(int signo);

#else
#
#endif
