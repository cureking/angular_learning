angular.module( 'app.register',
	[
		'ui.router'
	]
)

.controller( 'AccountController',
	[
		'$scope', '$state', 'register',
		function( $scope, $state, register ){

			$scope.username = 'aosnow2';
			$scope.password = 'aosnow';
			$scope.repass = 'aosnow';

			$scope.next = function(){

				if( $scope.username === '' || $scope.password === '' || $scope.repass === '' )
				{
					alert( "帐号、密码、确认密码不能为空。" );
					return;
				}

				register.setData( 'username', $scope.username );
				register.setData( 'password', $scope.password );
				register.setData( 'repass', $scope.repass );

				$state.go( 'register.profile' );
			};
		}
	]
)

.controller( 'ProfileController',
	[
		'$scope', '$state', 'register', 'utils',
		function( $scope, $state, register, utils ){

			$scope.curYear = '1990';
			$scope.curMonth = '08';
			$scope.curDay = '08';

			$scope.gender = '1';

			$scope.years = utils.createNumberArray( 2017, 1900 );
			$scope.months = utils.createNumberArray( 12, 1 );
			$scope.days = utils.createNumberArray( 31, 1 );

			$scope.daysChange = function(){
				console.log( $scope.curYear, $scope.curMonth );

				let max = utils.getMonthMaxDays( $scope.curYear, $scope.curMonth );
				$scope.days = utils.createNumberArray( max, 1 );
			};

			$scope.prev = function(){
				$state.go( 'register.account' );
			};

			$scope.next = function(){

				if( $scope.gender === '' )
				{
					alert( '未选择性别。' );
					return;
				}

				console.log( $scope.curYear, $scope.curMonth, $scope.curDay );

				if( $scope.curDay === '' )
				{
					alert( '生日日期错误。' );
					return;
				}

				register.setData( 'gender', $scope.gender );
				register.setData( 'birthday', $scope.curYear + "-" + $scope.curMonth + "-" + $scope.curDay );

				$state.go( 'register.detail' );
			};
		}
	]
)

.controller( 'DetailController',
	[
		'$scope', '$state', 'register',
		function( $scope, $state, register ){

			$scope.nickname = '大斯';
			$scope.email = 'aosnow@yeah.net';
			$scope.hobby = '书法，绘画';

			$scope.prev = function(){
				$state.go( 'register.profile' );
			};

			$scope.submit = function(){

				if( $scope.nickname === '' )
				{
					alert( '未设置昵称。' );
					return;
				}

				if( $scope.email === '' )
				{
					alert( '未设置邮箱地址。' );
					return;
				}

				if( $scope.hobby === '' )
				{
					alert( '未设置兴趣爱好。' );
					return;
				}

				console.log( 'commit data...' );

				register.setData( 'nickname', $scope.nickname );
				register.setData( 'email', $scope.email );
				register.setData( 'hobby', $scope.hobby );

				register.addUser();
			};
		}
	]
)

.config(
	[
		'$stateProvider', '$urlRouterProvider',
		function( $stateProvider, $urlRouterProvider ){
			$stateProvider
			.state( 'register.account', {
					url: '/account',
					templateUrl: "register/tpl/register.account.html",
					controller: "AccountController"
				}
			)
			.state( 'register.profile', {
					url: '/profile',
					templateUrl: "register/tpl/register.profile.html",
					controller: "ProfileController"
				}
			)
			.state( 'register.detail', {
					url: '/detail',
					templateUrl: "register/tpl/register.detail.html",
					controller: "DetailController"
				}
			);

			$urlRouterProvider.otherwise( '/' );
		}
	]
);