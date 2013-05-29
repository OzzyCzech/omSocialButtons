omSocialButtons
===============

How to install
--------------

Use [BOWER](http://twitter.github.com/bower/) from Twitter

    cd wp-content/plugins
    bower install git@bitbucket.org:OzzyCzech/omsocialbuttons.git

Callback actions
----------------
There are some action callbacks

```
before_[key]_initButton
after_[key]_initButton
before_[key]_getButtonHtml
after_[key]_getButtonHtml
```

Keys: facebook, twitter, googleplus, kindle, flatter

There is also one filter for content

```
omSocialButtonsContent
```




CSS example
-----------


```
.social-buttons .wrapper {
	margin: 0;
	padding: 5px 0;
	text-align: right;
	clear: both;
}

.social-buttons .wrapper .facebook:before {
	content: "Sdílejte: ";
}

.social-buttons .wrapper .twitter-share-button {
	width: 81px !important;
}

.social-buttons .wrapper *[id^=___plusone] {
	width: 60px !important;
}

.social-buttons .wrapper iframe {
	margin: 0;
	padding: 0;
}

.social-buttons .wrapper .fb-like:hover iframe {
	max-width: inherit !important;
	width: 450px !important;
}

.social-buttons .wrapper>div {
	display: inline-block;
	margin-left: 5px;
	height: 21px;
	line-height: 0;
	vertical-align: middle;
}

.post-social-buttons a:hover {
	opacity: 1;
	box-shadow: none;
}
```

If you want hide popup window:

```
.fb-like {
	height: 20px;
	overflow: hidden;
}
```

Todo
----
http://business.pinterest.com/widget-builder/#do_pin_it_button - Pinterest button
http://developer.linkedin.com/publishers - linked in button

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