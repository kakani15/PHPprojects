# Online Voting System
Please follow below instructions to make the code work.

1. Admin_Detail:
Aadhar card number: 12345678901234
Username: nikhnara
Password: nikhnara
Use the above details to navigate through admin page.

2. Download the nikhnara_db-3.sql file to establish the DB to view results on the webpage.
Now please navigate to Welcome_page.php which is the initial/starting page.

## Admin page:-
If you want to view admin page please use above details and login to admin page(admin_home_page.php). Admin has all the privileges to control the elections. Every option you see on the admin page will navigate you to that respective php pages, below are the pages that can be navigated through admin page,(admin.php, admin_home_page.php)

candidate_results.php( View candidate details, results )
add_candidate.php (Add candidates who are participating)
admin_passwordchange.php(Change password for admin)
add_constituencies.php(Add new constituencies )
assisting_centers.php(View centers where voters can go for assistance)
employee_details.php(View employee details who work for election commission)
add_employees.php(Add employees that work for election commission)
add_voters.php(Add voters into election commission table so that they can register for voting. When a new voter is added default vote count 1 is assigned to voter for both MLA and MP)
add_centers.php(add centers where people can go for assistance regarding voting)

## Instruction to keep in mind before adding details:
add_candidate.php:- 
Candidate role - it should be either "MLA" or "MP" as these are the only roles in indian elections

Candidate img:- U can copy image address from web page

Constituency ID/ District ID:- These are drop-down, if you don't see the option you are wanting that means it's not there yet in DB, thus you need to add constituencies/districts in add_constituencies.php first.

add_voters.php:-
Candidate ID/ District ID:- These are drop-down, if you don't see the option you are wanting that means it's not there yet in DB, thus you need to add constituencies/districts in add_constituencies.php first.

add_centers.php:-
Constituency ID:- These are drop-down, if you don't see the option you are wanting that means it's not there yet in DB, thus you need to add constituencies first.

add_employees.php:-
Is_Admin :- If you select this option a background trigger is going to run where it is going to add that particular employee into admin table. Select this option only if you want him to be a admin

Voting Assisting Center:- This is a dropdown if you don't see the option you need go and add it in voting_assisting_centers.php

Constituency ID:- These are drop-down, if you don't see the option you are wanting that means it's not there yet in DB, thus you need to add constituencies first.

Aadhar card number:- This a drop-down, if you don't see your aadhar number that means he/she is not in election commission database, so add his details in add_voter.php


PS :- Aadhar card number is a unique identification number assigned to a person. Duplicates are not allowed in this area.

Contact:-
Now the Contact you see on welcome page is to know whom to contact for assistance(all admins are going to be papered here) contact.php

Register:-
The register option you see on the screen is the option for users to register for voting, you can register for voting only if you are in the election commission database otherwise it prompts to with a message saying to contact election commission to get u added into database. Sole idea of this is that no duplicate and cross voting can be occurred. (registration_page.php, register.php)

Login:-
If you are registered then you can choose this option and login to vote.(voter_login.html, voter_login_page.php)
You can provide your credentials and login into the page, where you will be navigated to voter_home_page.php where you can see candidates participating in your constituency.

Voters will be able to see candidates that are participating only in their constituency , this functionality is implemented so that they can't vote to other and avoid cross voting. They can vote 1 vote to MLA and 1 to MP, not more that 1 vote to each individual will be assigned. Voter is restricted to not vote more than 1.(vote.php)

You can click on the candidate name to view/know particular candidate details.(candidate.php)

You can use below details to go to voter login page:-
Aadhar card number:-123456789012
password:- Bachupalli
dob:- 1990-01-01
