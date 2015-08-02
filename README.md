phabricator-pubsub
==================

Phabricator PubSub subscribes Phabricator to PubSubHubbub event feeds.  The main use case is GitHub.

These events are routed at the callback endpoint to a specific project id and then published via the conduit api as
 a feed story.
 
**INSTALLATION**

**BUGS**

Report issues by creating a task here:

-  https://phabricator.wikimedia.org/maniphest/task/create/
-  and then add the phabricator-pubsub-extension project.
