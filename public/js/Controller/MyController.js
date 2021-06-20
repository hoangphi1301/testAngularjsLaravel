import {Pagination} from '../pagination.js';

 app.controller('myController',function($scope,$http){
     
    var paginate = new Pagination();

        $scope.showUser = function(){
            $('#showUser').show();
            $('#showBook').hide();
            $http.get('user/index').then(function(response){
                $scope.users = [];
                $scope.maxPage = [];
                currentPage = 1;
                $scope.currentPage = currentPage;
                users = response.data;
                maxPageUser = Math.ceil(users.length/maxRow);
                for(var i =1;i<=maxPageUser;i++){
                    $scope.maxPage.push(i);
                }
                $(document).ready(function(){
                    paginate.checkPage(currentPage,maxPageUser,'.centerPaginationUser');
                })
                
                $scope.users = paginate.pagination(users,currentPage,maxRow);
            });
        }

        $scope.showBook = function(){
            $('#showUser').hide();
            $('#showBook').show();
            $http.get('book/index').then(function(response){
                books = response.data;
                $scope.maxPage = [];
                $scope.books = [];
                currentPage = 1;
                $scope.currentPage = currentPage;
                maxPageBook = Math.floor(books.length/maxRow) +1;

                for(var i = 1;i<= maxPageBook;i++){
                    $scope.maxPage.push(i);
                }
                $(document).ready(function(){
                    paginate.checkPage(currentPage,maxPageBook,'.centerPaginationBook');
                });
                $scope.books = paginate.pagination(books,currentPage,maxRow);
               
            });
        }

        $scope.pagination = function(value,status){
            currentPage = value;
            $scope.currentPage = currentPage;
            if(status == 'user'){
                $scope.users = [];
                paginate.checkPage(currentPage,maxPageUser,'.centerPaginationUser');
                $scope.users = paginate.pagination(users,currentPage,maxRow);
                }
            if(status == 'book'){
                $scope.books = [];
                paginate.checkPage(currentPage,maxPageBook,'.centerPaginationBook');
                $scope.books = paginate.pagination(books,currentPage,maxRow);
            }
        }

        $scope.eventModal = function(status,id){
            $scope.status = status;
            $scope.id = id;

            if(status == 'add'){
                $scope.user = null;
                $scope.titleModal = "Thêm User";
                $scope.erName = '';
                $scope.erEmail = '';
                $scope.erPassword = '';
                $scope.erRepassword = '';
                $('#userModal').modal('show');
            }

            if(status == 'edit'){
                $scope.titleModal = "Sửa User";
                $scope.erName = '';
                $scope.erEmail = '';
                $scope.erPassword = '';
                $scope.erRepassword = '';
                $('#userModal').modal('show');

                $http.get('user/edit/' + id).then(function(response){
                    $scope.user = response.data;
                },function(response){
                    console.log(response);
                });
            }

            if(status == 'delete'){
                console.log(users);
                var confirmDelete = confirm('Bạn có chắc muốn xóa ?');
                if(confirmDelete){
                    $http.get('user/delete/' + id).then(function(response){
                        $scope.users.forEach(function(value,index){
                            if(value.id == id){
                                $scope.users.splice(index,1);
                            }
                        });
                        users.forEach(function(value,index){
                            if(value.id == id){
                                users.splice(index,1);
                            }
                        });
                    },function(response){
                        console.log(response);
                    });
                }
            }
            
        }

        $scope.saveUser = function(status,id){
            if(status == 'add'){
                var data = $scope.user;
                $http({
                    method : 'POST',
                    url : 'user/store',
                    data : $.param(data),
                    headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
                }).then(function(response){
                    // console.log(response.data);
                    var errors = response.data.errors;
                    if(errors){
                        $scope.erName = '';
                        $scope.erEmail = '';
                        $scope.erPassword = '';
                        $scope.erRepassword = '';
                        if(errors.name){
                            $scope.erName = errors.name[0];
                        }
                        if(errors.email){
                           $scope.erEmail = errors.email[0];
                           }
                        if(errors.password){
                            $scope.erPassword = errors.password[0];
                        }
                        if(errors.repassword){
                            $scope.erRepassword = errors.repassword[0];
                        }
                        
                     }else{
                        if(response.data.success){
                            data.id = response.data.id;
                            $scope.users.push(data);
                            users.push(data);
                            $('#userModal').modal('hide');
                            }
                        }
                },function(response){
                    console.log(response);
                });
            }

            if(status == 'edit'){
                console.log(id);
                var data = $scope.user;
                $http({
                    method : 'POST',
                    url : 'user/update/'+id,
                    data : $.param(data),
                    headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
                }).then(function(response){
                    console.log(response);
                    var errors = response.data.errors;
                    if(errors){
                        $scope.erName = '';
                        $scope.erEmail = '';
                        $scope.erPassword = '';
                        $scope.erRepassword = '';
                        if(errors.name){
                            $scope.erName = errors.name[0];
                        }
                        if(errors.email){
                           $scope.erEmail = errors.email[0];
                           }
                        if(errors.password){
                            $scope.erPassword = errors.password[0];
                        }
                        if(errors.repassword){
                            $scope.erRepassword = errors.repassword[0];
                        }
                        
                     }else{
                        if(response.data.success){
                            console.log($scope.users);
                            $scope.users.forEach(function(value,index){
                                if(value.id == id){
                                    $scope.users[index] = data;
                                }
                            });
                            users.forEach(function(value,index){
                                if(value.id == id){
                                    users[index] = data;
                                }
                            });
                            $('#userModal').modal('hide');
                        }
                     }
                },function(response){
                    console.log(response);
                });
            }
        }

        $scope.searchUser = function(){
            $scope.users = [];
            users.forEach(function(value,index){
                if(value.name.indexOf($scope.search) >= 0){
                    $scope.users.push(value);
                }
            });
            if($scope.search == '') {
                $scope.users = [];
                paginate.checkPage(currentPage,maxPageUser,'.centerPaginationUser');
                $scope.users = paginate.pagination(users,currentPage,maxRow);
            }
        }

    });