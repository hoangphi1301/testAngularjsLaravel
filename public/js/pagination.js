export class Pagination {
    pagination(data,current,max){
        let books = [];
        data.forEach(function(value,index){
            if(index < current*max && index >= (current -1)*max){
                books.push(data[index]);
            }
        });
        return books;
    }
    checkPage(current,max,element){
        if(current == 1){
            $('.prev').hide();
        }else {
            $('.prev').show();
        }
        if(current == max){
            $('.next').hide();
        }else{
            $('.next').show();
        }
        $(''+element+'').each(function(index,value){
            if((index+1) < (current+4) && (index+1) > (current-4)){
                $(this).show();
                 if((index+1)==current){
                $(this).addClass('disabled');
                }else{
                    $(this).removeClass('disabled');
                }
            }else{
                $(this).hide();
            }
        });
    }
}