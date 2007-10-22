window.onload = function() {
	var addImages = function(images) {
		var gallery = $('gallery');
			images.each(function(image) {
				var el = new Element('div', {'class': 'preview'});
				var name = new Element('h3').setHTML(image.name).injectInside(el);
var link = new Element('a',{'href':''}).setHTML(image.link).injectInside(el);				var desc = new Element('span').setHTML(image.description).injectAfter(name);
				var img = new Element('img', {'src': 'images/' + image.src}).injectAfter(desc);
				var footer = new Element('span').injectAfter(img);
				if (image.views > 50 && image.views < 250) footer.setHTML('popular').addClass('popular');
				else if (image.views > 250) footer.setHTML('SUPERpopular').addClass('SUPERpopular');
				else footer.setHTML('normal').addClass('normal');
				el.inject(gallery);
			});
		}
			
	var url = 'http://localhost/tmp/javascript/mootools/data_blog.js';
	var request = new Json.Remote(url, {
		onComplete: function(jsonObj) {
			addImages(jsonObj.previews);
			}
	}).send();
}


window.addEvent('domready', function(){
	var addImages = function(images) {
		var gallery = $('gallery');
			images.each(function(image) {
				var el = new Element('div', {'class': 'preview'});
				var name = new Element('h3').setHTML(image.name).injectInside(el);
var link = new Element('a',{'href':''}).setHTML(image.link).injectInside(el);				var desc = new Element('span').setHTML(image.description).injectAfter(name);
				var img = new Element('img', {'src': 'images/' + image.src}).injectAfter(desc);
				var footer = new Element('span').injectAfter(img);
				if (image.views > 50 && image.views < 250) footer.setHTML('popular').addClass('popular');
				else if (image.views > 250) footer.setHTML('SUPERpopular').addClass('SUPERpopular');
				else footer.setHTML('normal').addClass('normal');
				el.inject(gallery);
			});
		}
			
		$('loadJson').addEvent('click', function(e) {
			e = new Event(e).stop();
			$('gallery').empty();
			var url = 'http://localhost/tmp/javascript/mootools/data_blog.js';
			var request = new Json.Remote(url, {
				onComplete: function(jsonObj) {
					addImages(jsonObj.previews);
				}
			}).send();
		});

		$('blog').addEvent('click', function(e) {
			e = new Event(e).stop();
			$('gallery').empty();
			var url = 'http://localhost/tmp/javascript/mootools/data.js';
			var request = new Json.Remote(url, {
				onComplete: function(jsonObj) {
					addImages(jsonObj.previews);
				}
			}).send();
		});
			
		$('clearJson').addEvent('click', function(e) {
			e = new Event(e).stop();
			$('gallery').empty();
		});
}); 