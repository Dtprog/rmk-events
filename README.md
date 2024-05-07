# RMK Events management plugin

## Shorty about

The plugin gives you the ability to create event records and display them to users. Users can see only those events that
have not happened yet.

Users can save the following event data: 
<ul>
<li>event name</li>
<li>event description</li>
<li>event picture</li>
<li>event dates</li>
<li>information about event organiser</li>
</ul>

## How to install

There are two ways for installing the plugin:
<ol>
<li>Install the plugin from the git repository and install it manually.</li>
<li>Install WordPress and the plugin using docker composer.</li>
</ol>

### 1. Install the plugin from git repository:

Clone or download the next git repository into your WordPress wp-content/plugins directory
```
 https://github.com/dtprog/rmk-events 
 ```

### 2. Install the plugin using docker compose:
Clone or download the docker-compose file from the repository 
```
 https://github.com/dtprog/rmk-events-docker-compose 
 ```
Go to the directory with this downloaded/cloned file and run the command:
```
docker-compose up -d
```


## Settings

Enter the admin zone of the project and go into Plugins menu item. There you can see our plugin named RMK Events Plugin.
Once activated, you will see the Events menu item appear.