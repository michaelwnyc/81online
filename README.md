81online
========

=====================!!!!! NOT READY FOR PRODUCTION USE !!!!! ============================
                     
                     Add user function has a major design fault 
                     and also the install script is not ready due 
                     to this design fault.
                     
==========================================================================================

This projects is a front-end user management platform based on OpenVPN.

It right now has the following features:

1. User

   1.1 Login to view the account status, including information such as total quota, used quota and left quota.
   
   1.2 Change the password.
   
   1.3 View the installation instruction.

2. Admin

   2.1 Login to view all users and admins.
   
   2.2 Add new users and admins.
   
   2.3 Delete users and admins.
   
   2.4 Change admin password.

3. To Do

   All mysql connections are made by using PHP mysql extension. In future, it is urgent to move to mysqli extension
   instead to avoid any secruity issues.

   The system is now Chinese version only. Multi-language support is considered to be added later.
   
   Front-end UI design is being developed.
   
   Add user with custom attributes.
   
   To be continued.
   
4. INSTALLATION

   You have to install openvpn first on your server. It needs openvpn-auth-pam.so in the openvpn directory. It can be
   find in the resource directory. For Debian you may use the following command:

         cp /usr/lib/openvpn/openvpn-auth-pam.so /etc/openvpn/

   pam-mysql needs to be installed. For Debian, use the following command to install it:

         aptitude install libpam-dev libpam-mysql libmysql++-dev sasl2-bin
   
   Also, you need to config pam-mysql. Add the following TWO lines in to '/etc/pam.d/openvpn'. If it doesn't exist, just
   create a new file:
   
         auth optional pam_mysql.so user=openvpn passwd=PASSWORD host=localhost db=openvpn table=user usercolumn=username passwdcolumn=password where=active=1 crypt=2
         account required pam_mysql.so user=openvpn passwd=PASSWORD host=localhost db=openvpn table=user usercolumn=username passwdcolumn=password where=active=1 crypt=2
   
   Remember to change the user, passwd, host and db according your database.
   
   Run

               saslauthd -a pam
   
   to start sasl authrization service.
   
   
   In your server.conf:
   
         Add   

               # user/pass auth from mysql
               plugin ./openvpn-auth-pam.so openvpn
               client-cert-not-required
               username-as-common-name
               
               # record in database
               script-security 2
               client-connect ./connect.sh
               client-disconnect ./disconnect.sh


   In your client.conf
   
         Comment out

               cert client.crt
               key client.key
   
         Add

               auth-user-pass
               
   If any part of the above code is already in your configuration file, don't just add it, but modify the existing
   config to above.
   
   The user runs openvpn process needs to have executing permission on connect.sh and disconnect.sh.
