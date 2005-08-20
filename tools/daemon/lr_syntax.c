
#include "lr_syntax.h"

int lr_syntax(int fd, license_data_type *ld, char *buff)
{

	char *ptr;

	char *ptr1;

	char qcommand [MAX_MSG_SIZE];

	time_t tim;

	ptr = strstr(buff, message(MSG_LS_CMD));
	ptr1 = strstr(buff, message(MSG_EQ_CMD));

	if (ptr != buff && ptr1 != buff) {

		if (send_line(fd, message(MSG_BAD_SYNTAX), strlen(message(MSG_BAD_SYNTAX))) < 0) {

			return (-1);

		}

		return (1);

	} else {

		char *lr_ans = calloc(MAX_MSG_SIZE, sizeof(char));

		if (ptr1 == buff) {

			/*
			 execute query:
			 chek do we have license status
			 if we have it - execute query and send ok
			 else send ERROR
			 */

			if (fork() == 0 ) {

				/*
				 execute it
				 */

				close(fd);

				tim = time(NULL);

				/*
				 make command with timestamps
				 */
				memset((void *) &qcommand, '\0', (size_t) sizeof(MAX_MSG_SIZE));
				sprintf(qcommand,
						"%s 1>%s/%s.%ld 2>%s/%s.%ld",
						QUERY_CMD,
						LOG_DIR,
						STDOUT_LOG,
						(long int) tim,
						LOG_DIR,
						STDERR_LOG,
						(long int) tim);
				system(qcommand);
				exit(0);

			}

			strcat(lr_ans, message(MSG_CMD_OK));
			strcat(lr_ans, " query scheduled for execution.\r\n");

			if (send_line(fd, lr_ans, strlen(lr_ans)) < 0) {

				free(lr_ans);

				return (-1);

			}

		}

	} 

	return (NO_ERROR);

}

