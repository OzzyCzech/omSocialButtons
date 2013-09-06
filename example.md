# Example

## CSS example

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

## Callback actions

There are some action callbacks, they are call before or after method call

```
before_[key]_initButton -
after_[key]_initButton -

before_[key]_getButtonHtml - call before getting selected button html
after_[key]_getButtonHtml - call after getting selected button html
```

Keys: ```facebook```, ```twitter```, ```googleplus```, ```kindle```, ```flatter```

You can also apply filter fot buttons content: ```omSocialButtonsContent```
