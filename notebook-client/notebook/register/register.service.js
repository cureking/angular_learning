angular.module( 'app.register.service', [] )

// A RESTful factory for retrieving contacts from 'contacts.json'
.factory( 'register',
	[
		'$http',
		function( $http ){
			let db = {
				register: {
					username: '',
					password: '',
					repass: '',
					gender: '',
					birthday: '',
					nickname: '',
					email: '',
					hobby: ''
				}
			};

			db.post = function( url, data, callback ){
				// 提交到服务器
				console.log( 'commit:', db.register );

				$http.post( url, data )
				.then(
					function( response ){
						if( typeof callback === 'function' )
						{
							callback( response.data );
						}
					},
					function( response ){
						console.log( response );
					}
				);
			};

			db.addUser = function(){
				db.register[ 'api' ] = 'reg';
				db.register[ 'action' ] = 'add_user';

				console.log( 'post before:', db.register );
				db.post( 'http://127.0.0.1/nb/api.php',
					db.register,
					function( data ){
						console.log( 'server[add-user]:', data );
					}
				);
			};

			db.setData = function( key, value ){
				db.register[ key ] = value;
			};

			return db;
		} ]
);