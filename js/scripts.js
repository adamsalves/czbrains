$( document ).ready(function() {
	var product_render = $('[data-js="product"]');
	var filters_render = $('[data-js="filters"]');

	$.getJSON('produtos.json', function(data) {
		var tmpl_product = $.templates("#tmpl_prod");
		var tmpl_filters = $.templates("#tmpl_filters");
		var product = tmpl_product.render(data);
		var filters = tmpl_filters.render(data);

		$(product_render).html(product);
		$(filters_render).html(filters);

		var check_product = $('[data-link="show"]');

		$(check_product).each(function(index){
			$(this).on('click', function(){
				var checked_elm = $(this).val();
				var data_search = $.grep(data, function(produto) {
					return produto.marca == checked_elm;
				});

				var tmpl_product = $.templates("#tmpl_prod");
				var product_search = tmpl_product.render(data_search);

				if ($(this).prop( 'checked' )) {
					$(product_render).html(product_search);
				} else {
					$(product_render).html(product);
				}
			})
		});	
	});
});

