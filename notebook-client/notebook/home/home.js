angular.module( 'app.home', [] )
.controller( 'HomeController', [
	'$scope', '$http',
	function( $scope, $http ){
		// 从 $http 获取服务端数据列表
		$http.post(
			'http://127.0.0.1/nb/api.php',
			{
				api: 'comment',
				action: 'get_list'
			}
		)
		.then(
			function success( response ){
				console.log( response );
				$scope.comment_list = response.data;
			},
			function error( response ){
				console.log( response );
			}
		);

		// 绑定到 $scope
		$scope.comment_list = [];

		$scope.nickname = '';
		$scope.content = '';
		$scope.submit = function( $event ){

			$event.preventDefault();
			$event.returnValue = false;

			$http.post(
				'http://127.0.0.1/nb/api.php',
				{
					api: 'comment',
					action: 'add',
					username: '',
					nickname: $scope.nickname,
					content: $scope.content
				}
			)
			.then(
				function success( response ){
					console.log( response );

					if( response.data[ 'err' ] === 0 )
					{
						// 更新当前列表
						// 思路：由后台返回一条留言
						// 将此新留言数据push到comment_list完成列表更新
						$scope.comment_list.unshift( response.data.item );

						// 还原表单初始状态
						$scope.nickname = '';
						$scope.content = '';
					}

					// 提示用户成功或者失败信息
					alert( response.data.msg );
				},
				function error( response ){
					console.log( response );
				}
			);
		};
	}
] );