function renderCategories(){
    refreshCategories();
    adresa="select_categories.php";
	$.get(adresa,procesareRaspuns).fail(procesareEsec);

}
function refreshCategories(){
    let ele=document.getElementById("categoriesList");
    while (ele.firstChild) {
        ele.removeChild(ele.lastChild);
    }
}

function procesareRaspuns(raspuns)
	{
	    console.log(raspuns);
        let json_data = JSON.parse(raspuns); //array asociativ
        categorii=[];
        for(var i in json_data)
            categorii.push([i, json_data [i]]);
        console.log(categorii); //array de tip [[key1,value1],[...]]
        categorii.forEach(categ => {
            let list = document.getElementById("categoriesList");
            var list_item = document.createElement('li');
            list_item.appendChild(document.createTextNode(categ[1]));
            list_item.classList.add("list-group-item");
            list_item.onclick = function(){chooseCategory(list_item);}
            list_item.style.cursor="pointer";
            list.appendChild(list_item);

        });
	}

	function renderProducts(raspuns)
    {
        refreshProducts();
        console.log(raspuns);
        let json_data = JSON.parse(raspuns); //array asociativ
        produse=[];
        for(var i in json_data)
           produse.push([i, json_data [i]]);
        console.log(produse);
        //$("#categorie").html(json_data['categorie'])
        produse.forEach(produs =>{
            $('#products').append(' <div class="row">\n' +
                '                    <div class="col">\n' +
                '                        <p class="nume-produs">Denumire Film1 Categorie1</p>\n' +
                '                        <button class="btn btn-danger" style="text-align: center;">Stergere</button>\n' +
                '                    </div >\n' +
                '                    <div class="col">\n' +
                '                        <img class="poza-produs" src="" alt="No image found">\n' +
                '                    </div>\n' +
                '                    <div class="col">\n' +
                '                        <p class="descriere-produs">Camp1</p>\n' +
                '                        <p class="pret-produs">Camp2</p>\n' +
                '                        <p>Camp3</p>\n' +
                '                    </div>\n' +
                '                </div>')
            $(".nume-produs").html(produs['1']['nume'])
            //$("#poza-produs").src=(produs['1']['photo'])
            document.getElementsByClassName("poza-produs").src=produs['1']['photo']
            $(".descriere-produs").html(produs['1']['description'])
            $(".pret-produs").html(produs['1']['price'])
            console.log(produs['1']['photo']);

        })
    }
    function refreshProducts()
    {
        let ele=document.getElementById('products');
        while (ele.firstChild) {
            ele.removeChild(ele.lastChild);
        }
    }

function procesareEsec(raspuns)
	{
	$("#fail").html(raspuns.responseText)
	}

function chooseCategory(item){
    let list_items = document.getElementsByTagName('li');
    for(li of list_items) 
    {
        li.classList.remove("active");
    }
    item.classList.add("active");
    console.log(item.textContent);
    $("#categorie").html(item.textContent);
    refreshProducts();
    adresa="choose_category.php?item="+ item.textContent;
    $.get(adresa,renderProducts);
}