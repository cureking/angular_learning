angular.module( 'app.utils.service', [] )

// A RESTful factory for retrieving contacts from 'contacts.json'
.factory( 'utils',
	[
		function(){
			return {
				/**
				 * 求指定年月的最大天数
				 * @param year
				 * @param month
				 * @return {Number}
				 */
				getMonthMaxDays: function( year, month ){
					// 根据年月，获取正确的当月天数
					// 思路：将月置于下个月1号，再减去1天的毫秒数，得到当月最后一天的日期，即当月总天数
					let date = new Date();
					date.setFullYear( parseInt( year ), parseInt( month ), 1 );
					date.setTime( date.getTime() - 86400000 );

					return parseInt( date.getDate() );
				},

				/**
				 * 生成数值数组，元素为start至end之间的数值
				 * @param end
				 * @param start
				 * @return {Array}
				 */
				createNumberArray: function( end, start ){
					let r = [];

					if( start === undefined ) start = 0;

					for( let i = start; i <= end; i++ )
					{
						r.push( i );
					}

					return r;
				}
			};
		} ]
);