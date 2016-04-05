# Amazon Web Services

A demonstration of creating an ec2 Bitnami LAMP instance on Amazon Web Services (AWS). Screencast available on [YouTube: Amazon Web Services Tutorial](https://www.youtube.com).

## AWS Console

1.  Log-in into account.
2.  Select "EC-2" icon in top-left corner.
3.  Underneath "Create Instance" (within middle section of page), click the "Launch Instance" button.

## Create Instance

1.  _Choose AMI:_ Upon landing on the first step of the instantation (Step 1 Choose an Amazon Machine Image (AMI)), search for "LAMP" and select the "LAMP Stack powered by Bitnami" from the results.
2.  _Choose Instance Type:_ For the sake of this exercise, we will proceed with the "Microinstance", so just click on the "Review and Launch" button- no other selections are required for free-tier, which means steps 3-6 will be skipped.
3.  _Review:_ Again, this is a free-tier demo, which means steps 3-6 have been skipped, so just click on the "Launch" button.
4.  Launch will prompt a window with a request to "Select an existing key pair or create a new key pair"; in this example, we will select "Create a new key pair" from the dropdown menu within the window called "awsExample" creating a .pem file (a private key required for Secure SHell (SSH)) which will be downloaded and saved within our local subfolder on our desktop.
5.  Upon launching, a successful confirmation message should appear within the next page; please select "View Instances" to begin interacting with the Instance from the command-line.

## EC2 Dashboard

1.  After completing the last process, the EC2 Dashboard is now in view. In my screencast, I have two other instances running for academic projets, but let us stick to the example "awsExample" instance (obviously, you could've named yours whatever).
2.  Click on the row within your AWS instance dashboard of the instance name contained within the column "Key Name".
3.  A window beneath the Instance table will appear displaying the "PUBLIC DNS address", which is essentially the URL, or website address, where your instance will be located. Highlight/Copy/Paste and save that URL within a text file; you may view the instance by simply prefixing to the Public DNS then navigating to the browser to test.
4.  Next, within the console, click on the "Actions" button, hover over "Instance Settings" and then click on "Get System Log"; scroll-down until you see a box outlined in hashtags(#) outlining the text "Setting Bitnami application password to"; copy/paste that password and note that in the text file **_BUT DO NOT SHARE IT_** as your instance could potentially be hacked. Now exit the window.
5.  Click on the "Connect button" and note the following [bash scripts](http://ryanstutorials.net/bash-scripting-tutorial/bash-script.php); for this exmample the exampled displayed:

`ssh -i "aws_example.pem" ubuntu@ec2-52-25-111-159.us-west-2.compute.amazonaws.com`

Also click on the Java SSH Client Directly from my browser (Java required) radio button to note the username if you would like to use FileZilla.

## The Command-line

1.  Fire-up your terminal; in the screencast, the iTerm terminal was used. From the root folder '~/' within the user directory, change directories with `cd desktop/aws`. This tut includes a cheatsheet of other UNIX commands for clarification.
2.  Copy/paste the bash script noted in your text-file:

    `ssh -i "aws_example.pem" ubuntu@ec2-52-25-111-159.us-west-2.compute.amazonaws.com`

    to successfully log-in into your instance.
3.  Type in `ls` (list directory) on command-line to list the available folders. Type `cd public_html`to change directories into the public_html folder that is served by this instance. If interested, feel free to nano into the 'index.html' file to see the code currently rendered on the landing-page of your instance (`e.g. nano index.html`) Be sure to exit the file by typing "Control + X" and Type "N" to avoid saving changes.

## FileZilla

1.  Download [FileZilla](https://filezilla-project.org/) and launch the app.
2.  Click on the 'File' from menu-bar and select 'Site Manager'.
3.  In the 'Site Manager' window, click-on 'New Site' and type your instance-name.
4.  Copy paste the Public DNS address from your scratch-text-file and input that into the "Host" field.
5.  Select SFTP - SSH File Transfer Protocol from the dropdown menu.
6.  Select 'Normal' Logon Type.
7.  Enter 'ubuntu' in the 'User' field (this was noted earlier in within the step 5 of AWS).
8.  Clear password field so it's empty.
9.  Then click 'connect' button which should ensure successful log-in to your AWS instance from FileZilla.

## Create a basic form within your Bitnami LAMP instance.

1.  We will create a basic-form to interact with the backend of this AWS. LAMP is an acronym for the type of application stack delivering this production, which stands for **L**inux**A**pache**M**ySQL**P**HP. If interested, please read more about it at [StackOverlow](http://stackoverflow.com/questions/10060285/what-is-a-lamp-stack).
2.  Download my example files available on GitHub and select the three '.php' files, then drag and drop into the right column representing the AWS directory within the FileZilla window.
3.  To confirm successful upload, feel free to nano into the 'login.php' file- so type `nano login.php`. Now would be an opportune time to copy/paste the Bitnami application password retrieved in step 4 of the 'EC2 Dashboard' process; enter that password between the single-quotes. Type 'CTRL + X' then type 'Y' to save.
4.  Now append '/createDB_TBL.php' to the Public DNS address within the browser address-bar that landed on the ec2 instance to the Public DNS/website address and then go to that address.
5.  On the front-end, the web-page should display a confirmation but let's confirm success on the back-end.
6.  Go back to the terminal and type-in the following to interact with the database:`mysql -u root -p`

## MySQL

The password entered will be the same password referenced in the 'login.php' file, which again was originally derived from step #4 of 'EC2 Instance' instructions.

1.  Congrats- you should be in MySQL! Now type: `show databases`
2.  Type `'use music'` to use the database named in the 'login.php' file, which also contains the 'mymusic' table specified in the 'createDB_TBL.php' file.
3.  Type `desc mymusic` to see the id and corresponding columns which will store that data eventually input.
4.  Type `quit` to exit MySQL
5.  Next, go to your instance page prefixed with /mysqltest.php (e.g. in screencast example it was '')
6.  An elementary form should be displaued with fields to input 'Artist' and 'Album'. Have at it! Enter some bangers.
7.  Type enter and you will see your tunes returned! This means that data is contained within the back-end.
8.  To verify, type `mysql -u root -p` (remember, copy and paste the password noted in step #6).
9.  Now type `SELECT * FROM music;`
10.  [DoofDoof](https://soundcloud.com/alexanderjsingleton) music.

## You are now ready to begin exploring the wonderful world of php web development! Feel free to contact me if you wish to connect and chat about all the things. Thanks!
