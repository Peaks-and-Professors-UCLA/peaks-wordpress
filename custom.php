/*

Theme Name: X – Child Theme
Theme URI: http://theme.co/x/
Author: Themeco
Author URI: http://theme.co/
Description: Make all of your modifications to X in this child theme.
Version: 1.0.0
Template: x

*/

.thumb1 { 
    background: url(<?php the_post_thumbnail_url($size='full') ?>) 50% 50% no-repeat; /* 50% 50% centers image in div */
    width: 250px;
    height: 250px;
}
  
.thumb1 a {
    display: block;
    width: 250px;
    height: 250px;
}

/*****
    General
*****/

.my-container {
    margin: 2em 2em;
}

.big-header {
    font-size: 50px;
    font-weight: 400;
    max-width: 95%;
    text-align: center;
    margin: 1em auto 1em auto;
}

.medium-header {
    font-size: 36px;
    font-weight: 400;
    max-width: 95%;
    text-align: center;
    margin: 1em auto 1em auto;
}

.small-header {
    font-size: 30px;
    font-weight: 400;
    max-width: 80%;
    text-align: center;
    margin: 0.5em auto 1em auto;
}

@media only screen and (min-width: 768px) {
    .my-container {
        margin: 2em 6em 4em 6em;
    }

    .big-header {
        font-size: 80px;
        max-width: 80%;
    }

    .medium-header {
        font-size: 70px;
        max-width: 80%;
    }
}

.image-title-container {
    position: relative;
    text-align: center;
    color: white;

    margin: 20px 0px;
}

.image-title-text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);

    font-size: 35px;
    font-family: "Lato" sans-serif;
    text-shadow: 1px 1px #000000;
    font-weight: 600;

    line-height: 1.2;
}

.image-title-image {
    margin: 0px;
}

@media only screen and (min-width: 768px) {
    .image-title-container {
        margin: 30px 0px;
    }
    .image-title-text {
        font-size: 80px;
    }

    .image-title-image {
        max-height: 600px;
    }
}

.mtxl {
    margin-top: 4em;
}

.back-link a:hover {
    text-decoration: underline;
}

.content-text {
    font-size: 16px !important;
}

.email-form h1 {
    font-size: 20px !important;
    font-weight: 400;
}

p a {
    color: black !important;
}

a:hover {
    color: black !important;
}

.text-normal {
    color: rgb(75, 75, 75) !important;
}

.text-dark {
    color: rgb(63, 63, 63) !important;
}

a img {
    transition-duration: 300ms;
}

a img:hover {
    opacity: 0.8;
    transition-duration: 300ms;
}

/*****
    Home page
*****/

.home-container {
    margin: 0 2em;
}

@media screen and (min-width: 768px) {
    .home-container {
        margin: 0 9em 4em 9em;
    }
}

.home-container p {
    font-size: 20px;
}

.trip-preview-row {
    text-align: center;
}

.trip-preview-image {
    height: 250px;
}

.home-container a {
    color: rgb(51, 153, 255) !important;
}

.home-container a:hover {
    text-decoration: underline;
}

.home-container .announcement {
    font-size: 24px;
    font-weight: 600;
    text-align: center;
    margin-bottom: 30px;
}

/*****
    Header and footer stuff
*****/
.x-navbar .x-container.max {
    max-width: 100%;
}

.menu-item:hover {
    border: none;
}

.x-navbar {
  background-color: lightblue;
}

.x-colophon {
	background-color: lightblue;
}
i.x-icon-facebook-square {
	color: black;
}

i.x-icon-instagram {
  color: black;
}

/*****
    Trips stuff
*****/

@media only screen and (min-width: 768px) {
    .trip-row {
        margin-bottom: 3em;
    }
}

.trip-title-archive {
    margin-top: 0;
    margin-bottom: 12px;
    display: inline;
}

.trip-title-archive a:hover {
    box-shadow: inset 0 -1px rgb(137, 137, 148);
}

.trip-date {
    font-size: 14px;
}

.trip-description {
    font-size: 16px;
}

.trip-signup-button {
    background-color: rgb(61, 61, 204) !important;
    text-shadow: 1px 1px black;
    padding: 1em;
    margin: 5px 5px 10px 0px;
    display: inline-block;
    border-radius: 5px;
}

.trip-signup-button a {
    color: white !important;
}

.trip-signup-button:hover {
    color: white !important;
    box-shadow: 1px 1px 1px black;
}


/*****
    Leads stuff
*****/

.lead-title-archive {
    text-align: center;
}

.lead-title-archive a {
    font-size: 20px;
    color: black;
}

.lead-title {
    margin-top: 0.1em !important;
    margin-bottom: 0.1em !important;
}

.lead-position-title {
    margin-top: 0.1em !important;
    font-size: 20px;
    text-align: center;
}

.lead-description {
    font-size: 16px;
}

.lead-content {
    margin-top: 2em;
}

.lead-thumbnail {
    max-height: 200px;
    margin: auto;
    display: block;
}

/*****
    Contact page
*****/

.contact-container {
    max-width: 90%;
    margin: auto;
}

.contact-container p input.wpcf7-submit {
    display: block;
    margin: 0 auto;
}

.ajax-loader {
    display: block;
}
    

@media screen and (min-width: 768px) {
    .contact-container {
        max-width: 60%;
    }
}
