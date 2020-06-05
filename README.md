
<!-- PROJECT SHIELDS -->
[![Contributors][contributors-shield]][contributors-url] [![Forks][forks-shield]][forks-url] [![Stargazers][stars-shield]][stars-url] [![Issues][issues-shield]][issues-url] [![MIT License][license-shield]][license-url] [![LinkedIn][linkedin-shield]][linkedin-url]

<!-- PROJECT LOGO -->
<br />
<p align="center">
  <h3 align="center"> A tool to be used in an interactive experiment on the effect of sequential information on the formation of generic beliefs</h3>

  <p align="center">
The purpose of the experiment is to investigate the claim that generics are formed about a target group through a process of associative learning, which considers both the target of learning as well as a relevant contrast class.

The experiment described in this thesis is part of an ongoing investigation by the Logic and Language (LoLa) research group of the Institute for Logic, Language and Computation (ILLC) of the University of Amsterdam. 
[![Logic and Language - University of Amsterdam][uva-logo =50x]](https://www.illc.uva.nl/Research/Programmes/LoLa/)
    <br />
    <a href="https://github.com/BodiB/UvA_Generics"><strong>Explore the docs »</strong></a>
    <br />
    <br />
    <a href="http://uva-generics.nl/demo/">View Demo</a>
    ·
    <a href="https://github.com/BodiB/UvA_Generics/issues">Request Feature</a>
  </p>
</p>

<!-- TABLE OF CONTENTS -->
## Table of Contents

* [About the Project](#about-the-project)
  * [Built With](#built-with)
* [Getting Started](#getting-started)
  * [Prerequisites](#prerequisites)
  * [Installation](#installation)
* [Usage](#usage)
* [Roadmap](#roadmap)
* [Contributing](#contributing)
* [License](#license)
* [Contact](#contact)
* [Acknowledgements](#acknowledgements)



<!-- ABOUT THE PROJECT -->
## About The Project

[![Experiment screenshot][product-screenshot]](https://uva-generics.nl/demo)


### Languages used
* AJAX
* CSS
* HTML
* JavaScript
* jQuery
* PHP

## Getting Started
To get a local copy up and running follow these simple steps.

### Prerequisites
This is an example of how to list things you need to use the software and how to install them.
* npm
```sh
npm install npm@latest -g
```

### Installation
1. Clone the UvA_Generics
```sh
git clone https://github.com/BodiB/UvA_Generics.git
```
2. Install NPM packages
```sh
npm install
```

## Usage
### Setting up the experiment.
1. Set up a `web server` and a `MySQL database`.
2. Copy all files from the ["Code/website" directory ](https://github.com/BodiB/UvA_Generics/Code/website) into your `public_html` folder.
3. Import the database file stored in ["Code/database" directory ](https://github.com/BodiB/UvA_Generics/Code/database) into the database you just set-up
4. Open the `db.php` file and fill in your database information.
5. Open `admin.php` and change the `$username`  and `$password` variables in the first section with the username and password you would like to use to log in to the admin menu.
6. Go to `your_url/admin.php` and login with the username and password set in step 5.
7. Set up all necessary values in the `Settings`, `Statements` and `Features` menu. 
*Notes: 
	1. The `Max # questions`  setting must match the number of statements and features in the other menu's.*
	2. The `Referal link back to Prolific` setting can be left empty if Prolific is not used to recruit participants.
8. 
	- If you wish to use `reCAPTCHA`, go to [https://developers.google.com/recaptcha](https://developers.google.com/recaptcha) and set up you `reCAPTCHA`. Than move to `captcha.js` and `submit.php` in your `public_html` folder and set the necessary values there, these are: `$recaptcha_url` and `$recaptcha_secret` in `submit.php` and `var captchaPublic` in `captcha.js`.  
	- If you do not wish to use `reCAPTCHA`,  in your `index.php` set the `$_SESSION["recaptcha"]` value to `1`.
### Gathering data
Spread the experiment using either the link: `your_url/new_user.php` or when using Prolific, fill in the following link there: `your_url/prolific.php`

### Evaluating data
#### Feedback
Participants can give feedback on their experience after their participation. An overview of this feedback is available on the `Feedback` section of the `admin menu`.  
#### Results
In the `Results` section of the `admin menu`, you are able to see the gathered results in a table form. You can also download the data as a `CSV-file`.



<!-- CONTRIBUTING -->
## Contributing

Contributions are what make the open source community such an amazing place to be learn, inspire, and create. Any contributions you make are **greatly appreciated**.

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature`)
3. Commit your Changes (`git commit -m 'commit comment'`)
4. Push to the Branch (`git push origin feature`)
5. Open a Pull Request


<!-- LICENSE -->
<!--## License -->
<!--Distributed under the ?? License. See `LICENSE` for more information. -->

<!-- CONTACT -->
## Contact

Bodi Boele - bodiboele@gmail.com

Project Link: [https://github.com/BodiB/UvA_Generics](https://github.com/BodiB/UvA_Generics)

<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->
[contributors-shield]: https://img.shields.io/github/contributors/BodiB/UvA_Generics?style=flat-square
[contributors-url]: https://github.com/BodiB/UvA_Generics/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/BodiB/UvA_Generics?style=flat-square
[forks-url]: https://github.com/BodiB/UvA_Generics/network/members
[stars-shield]: https://img.shields.io/github/stars/BodiB/UvA_Generics?style=flat-square
[stars-url]: https://github.com/BodiB/UvA_Generics/stargazers
[issues-shield]: https://img.shields.io/github/issues/BodiB/UvA_Generics?style=flat-square
[issues-url]: https://github.com/BodiB/UvA_Generics/issues
[license-shield]: https://img.shields.io/github/license/BodiB/UvA_Generics?style=flat-square
[license-url]: https://github.com/BodiB/UvA_Generics/blob/master/LICENSE.txt
[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-black.svg?style=flat-square&logo=linkedin&colorB=555
[linkedin-url]: https://linkedin.com/in/bodi-boelé-52490710a
[product-screenshot]: images/screenshot.png
[uva-logo]: images/UVA-logo.png
