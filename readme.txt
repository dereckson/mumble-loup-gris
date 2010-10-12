Abstract
========

This is a collection of files used to print online lists on a Mumble server.

Files
=====

.
├── scripts                             Unix scripts (tested under FreeBSD 8/9)
│   ├── mumble-who                          Prints who is connected to mumble
│   └── mumble-who-diff                     Notifier printing join/exit
│
├── www-list                            Who's online? lists
│   │
│   ├── Sajax.php                           Handles XMLHTTPRequest
│   │
│   ├── list-white.php                      Clear, big, fine typography list
│   ├── list-white.css                      Its CSS
│   │
│   ├── list.php                            Black/gray version, if white=bright
│   ├── list.css                            Its CSS
│   └── logo.png                            Inverted version from pamela logo
│ 
└── www-pamela                          Files to add/replace to Pamela
    │                                   URL: http://github.com/sandb/pamela
    ├── img
    │   └── loup-gris-zarakai-03.png        Logo by Zarakai
    ├── js
    │   ├── pamela-buttons.js               Link to the mumble server
    │   └── pamela-nodes.js                 Logo
    │
    └── macs.php                            Calls mumble-who and jsonize

How to enable a console notification on join/part?
==================================================

If you open often new shells (are u tmux addict?):

    Adds in your .login file the following line:
    $HOME/scripts/user/dashboard