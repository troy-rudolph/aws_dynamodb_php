# AWS DynamoDB PHP Tutorial

This is based very closely on the tutorial located at https://docs.aws.amazon.com/amazondynamodb/latest/developerguide/GettingStarted.PHP.html

This code does not use a locally installed copy of DynamoDB.  It uses one, via normal key/secret authenication, in AWS.  You can generate keys in your personal account for DynamoDB access or, you can update the code to use a locally installed copy of DynamoDB.  You can follow the directions at the link above to do that.

If you do use a remote AWS Dynamo DB, put your keys in the credentials.json file located in the config directory.

I used a new version of the SDK than the one the tutorial uss.  The only difference is the way the DynamoDB client object is created.

Happy Experimenting!


