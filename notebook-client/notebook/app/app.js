let app = angular.module(
	'app',
	[
		'app.home',
		'app.register',
		'app.register.service',
		'app.filters',
		'app.utils.service',
		'ui.router'
	]
)

.config( [
	'$stateProvider', '$urlRouterProvider', '$httpProvider',
	function( $stateProvider, $urlRouterProvider, $httpProvider ){
		$stateProvider
		.state( 'home', {
				url: '/',
				templateUrl: "home/tpl/home.html",
				controller: "HomeController"
			}
		)
		.state( 'register', {
				url: '/register',
				templateUrl: "register/register.html",
				controller: "RegisterController"
			}
		);

		$httpProvider.defaults.transformRequest = function( datas ){
			let str = [];
			for( let p in datas )
			{
				str.push( encodeURIComponent( p ) + "=" + encodeURIComponent( datas[ p ] ) );
			}
			return str.join( "&" );
		};
		$httpProvider.defaults.headers.post = {
			'Content-Type': 'application/x-www-form-urlencoded'
		};

		$urlRouterProvider.otherwise( '/' );
	}
] )

.controller( 'RegisterController',
	[
		'$scope', '$rootScope', '$state',
		function( $scope, $rootScope, $state ){
			$scope.active = $state.current.name;

			$scope.getState = function( toState ){
				$scope.active = toState.name;
			};

			$rootScope.$on(
				'$stateChangeStart',
				function( event, toState, toParams, fromState, fromParams ){
					//console.log( $state.$current.name, toState[ 'name' ] );
					$scope.getState( toState );
				}
			);
		}
	]
)

.controller(
	'AppController',
	[
		'$scope', '$state', '$location',
		function( $scope, $state, $location ){
			// 测试用功能：默认跳转到注册页面
			// console.log( 'start location to:', $state.current );

			// 跳转路由（一）
			// go 方法只能用在运行时，不能在初次启动项目时默认跳转
			//$state.go( 'register.account' );

			// 跳转地址（二）
			// path或者url 方法适用于项目启动时跳转
			// $location.path( '/register/account' );
		}
	]
);