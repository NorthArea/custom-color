# test custom-color
[Bootstrap](https://getbootstrap.com/) 4.1 & [OctoberCMS](https://octobercms.com/) (laravel)
___

use [SASS](https://sass-lang.com/)

```bash
	$ sass scss/styles.sass scss/styles.css --style compressed
```

or insert this code in your October theme:

```html
	<head>
	.....
	<link href="{{ ['@framework.extras','assets/scss/styles.scss']|theme }}" rel="stylesheet">
	....
	</head>
```
