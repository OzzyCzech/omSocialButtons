omSocialButtons
===============

How to install
--------------

Use [BOWER](http://twitter.github.com/bower/) from Twitter

    cd wp-content/plugins
    bower install git@bitbucket.org:OzzyCzech/omsocialbuttons.git

CSS example
-----------


```
.social-buttons .wrapper {
	margin: 0;
	padding: 5px 0;
	text-align: right;
}

.social-buttons .wrapper .twitter-share-button {
	width: 81px !important;
}

.social-buttons .wrapper *[id^=___plusone] {
	width: 65px !important;
}

.social-buttons .wrapper iframe {
	margin: 0;
	padding: 0;
}

.social-buttons .wrapper>div {
	display: inline-block;
	margin-right: 10px;
	height: 20px;
	line-height: 0;
	vertical-align: middle;
}
```

Release notes
-------------

2.0
- new interface for buttons work well with new Wordpress
- refactoring for simple way for add new Buttons

1.1
- bugfixes in Google Plus Icon
- rename plugin to omSocialButtons (there is another plugin with name Buttons)

1.0
- first public version with Google Plus, Facebook and Twitter button for Wordpress