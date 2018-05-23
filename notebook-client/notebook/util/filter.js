angular.module( 'app.filters', [] )

.filter( "prefixNumber", function(){
	return function( input, retain ){
		if( retain === undefined ) retain = 2;

		let out = '0' + input;
		let last = out.length - retain;
		out = out.substr( last > 0 ? last : 0 );

		return out;
	};
} )

.filter( "msdate",
	[
		'$filter',
		function( $filter ){
			return function( input, format ){
				if( format === undefined ) format = 'yyyy-MM-dd';
				let ms = parseInt( input ) * 1000;

				return $filter( 'date' )( ms, format );
			};
		}
	]
);
