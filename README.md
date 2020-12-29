This is the branch to work on for KeizerPHP 2.0 - Laravel 8.x version
Changes to Laravel 8.X, Use of Tailwind instead of Bootstrap and AlpineJS or VueJS
## About KeizerPHP
<p>This project is made with the Laravel Framework. All rights reserved to the third party vendor packages that make this work.</p>
<p>KeizerPHP is an implementation of Systeem Keizer that is used by chess clubs to pair their internal competition. I try to provide an web-based, open-source alternative for software like Sevilla (JBF) as I missed this.</p>
<p>It is just a hobby project, so if things are broken or if you think things can be better. Please do so. The first version that is now available has loads of features that come in handy:</p>
<ol>
<li> User-system (mass creation of users by uploading a ratinglist or single creation of users by the Administrator)</li>
<li> Users can configure their own personal settings</li>
<li> Password Forget option</li>
<li> Competition Configs, easy to manage</li>
<li> Dashboard with information about the upcoming round</li>
<li> Easy to create rounds</li>
<li> Notify players when pairings are done or rankings are updated (WebPush, E-mail, Website)</li>
<li> Absence generator and editing by players themselves.</li>
<li> Pairing based on Systeem Keizer (random Bye, Algorithm to determine if very strong player is at the bottom of the ranking due to first game should be paired against the players above him)</li>
<li> Add multiple Administrators (not fully tested)</li>
<li> Ranking, including some details like TPR, but also showing all games of a player and the score for that game</li>
<li> Installation Package in the app (not yet an installation of the whole app, so you will need to copy the source and upload it to your hosting)</li>
<li> Multiple Language Support (Dutch / English (WIP))</li>
<li> A sort of API to create your own applications on top of it (i.e. for iOS)
<ul>
<li>User Login to pick up the API Key for the user.</li>
<li>Read games of the authenticated user with his API Key</li>
<li>See for a small implementation example <a href="https://github.com/Frank-L93/DePionApp/">DePionApp</a></li>
</ul>
</li>
</ol>

<p>In the future, there will be more:</p>
<ol>
<li> Layouts (There is actually a second layout, making the background blue)</li>
<li> Notifications via SMS or WhatsApp, and WebPush</li>
<li> Better Pairing Algorithm</li>
<li> PGN-games to analyze games</li>
<li> Sourcecode rewritten</li>
</ol>


## About Laravel

Laravel is a web application framework with expressive, elegant syntax.
KeizerPHP is now based on a 7.x version of Laravel. Begin 2021, KeizerPHP 2.0 will be released based on Laravel 8.x. 

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
