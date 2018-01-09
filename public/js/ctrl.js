app.controller("myCtrl",function($scope, $http, ngDialog, $filter, $compile) {
 
$scope.filterdropdown = 0;
$scope.games = [];
$scope.allactiveGames = [];

$scope.assigngames = function(index){
	$scope.games['game' + index] = 1;
}
$scope.toggleGames = function(index){
	$scope.games['game' + index] = !$scope.games['game' + index];
}
	
$scope.customersDataSource  = [{
    "UniqueID": "01",
    "GameName": "India vs Australia"
},{
    "UniqueID": "02",
    "GameName": "John Millman v Damir Dzumhur"
},{
    "UniqueID": "03",
    "GameName": "Ekaterina Alexandrova v Kateryna Kozlova"
},{
    "UniqueID": "02",
    "GameName": "Petr David v Michal Kadlcek"
},{
    "UniqueID": "01",
    "GameName": "Kateryna Bondarenko v Nao Hibino"
},{
    "UniqueID": "01",
    "GameName": "Zoe Hives v Viktorija Rajicic"
},{
    "UniqueID": "03",
    "GameName": "England vs Westindies"
},{
    "UniqueID": "02",
    "GameName": "Somerset vs Manchester"
}];
$scope.customOptions = {
	dataSource: $scope.customersDataSource,
	dataTextField: "GameName",
	dataValueField: "UniqueID",

	// using {{angular}} templates:
	valueTemplate: '<span class="selected-value" style="background-image: url(\'https://demos.telerik.com/kendo-ui/content/web/Customers/{{dataItem.GameID}}.jpg\')"></span><span>{{dataItem.GameName}}</span>',
	
	template: '<span class="k-state-default" style="background-image: url(\'https://demos.telerik.com/kendo-ui/content/web/Customers/{{dataItem.UniqueID}}.jpg\')"></span>' +
			  '<span class="k-state-default"><h3>{{dataItem.GameName}}</h3></span>',
};

$scope.tabs = [{
            firstteam: 'India',
            secondteam: 'Australia',
            url: 'one.tpl.html'
        }, {
            firstteam: 'Pakistan',
            secondteam: 'Sri Lanka',
            url: 'two.tpl.html'
        }, {
            firstteam: 'South Africa',
            secondteam: 'Bangladesh',
            url: 'three.tpl.html'
        }];
$scope.plustab = [{

}];
    $scope.currentTab = 'one.tpl.html';

    $scope.onClickTab = function (tab) {
        $scope.currentTab = tab.url;
    }
    
    $scope.isActiveTab = function(tabUrl) {
        return $scope.currentTab == tabUrl;
    }


$scope.gametabs = [{
            title: 'CURRENT MARKET',
            url: 'currentmarket.tpl.html'
        }, {
            title: 'LOGIN USERS',
            url: 'tennis.tpl.html'
        }, {
            title: 'MATCHED BETS',
            url: 'soccer.tpl.html'
        }];

$scope.currentgameTab = 'cricket.tpl.html';

    $scope.onClickgameTab = function (gametab) {
        $scope.currentgameTab = gametab.url;
    }
    
    $scope.isActivegameTab = function(gametabUrl) {
        return gametabUrl == $scope.currentgameTab;
    }

/******** Master Inplay Three Tabs **********/
$scope.bettabs = [{
            title: 'CURRENT MARKET',
            url: 'currentmarket.tpl.html'
        }, {
            title: 'LOGIN USERS',
            url: 'loginuser.tpl.html'
        }, {
            title: 'MATCHED BETS',
            url: 'matchedbets.tpl.html'
        }, {
            title: 'UNMATCHED BETS',
            url: 'unmatchedbets.tpl.html'
        }];

$scope.currentbetTab = 'currentmarket.tpl.html';

    $scope.onClickbetTab = function (bettab) {
        $scope.currentbetTab = bettab.url;
    }
    
    $scope.isActivebetTab = function(bettabUrl) {
        return bettabUrl == $scope.currentbetTab;
    }
/******** End Master Inplay Three Tabs **********/

$scope.togglePostioncard = function(gamecard) {

        if($scope.indVSaus_card == gamecard){
            $scope.indVSaus_card = 0;       
        }
        else{
            $scope.indVSaus_card = gamecard;    
        }
    }

$scope.togglemasterInplay = function(masterpopup) {

        if($scope.inplayMaster_card == masterpopup){
            $scope.inplayMaster_card = 0;       
        }
        else{
            $scope.inplayMaster_card = masterpopup;    
        }
    }


$scope.toggleInplayform = function(gameform){
    if($scope.placebet_form == gameform){
        $scope.placebet_form = 0;
    }
    else{
        $scope.placebet_form = gameform;
    }
}

 $scope.noleftbetitemList = [{
    "quantity": "0"
  }];
  $scope.norightbetitemList = [{
    "quantity": "0"
  }];
  $scope.yesleftbetitemList = [{
    "quantity": "0"
  }];
  $scope.yesrightbetitemList = [{
    "quantity": "0"
  }];
  $scope.increaseItemCount = function(item) {
    item.quantity++;
  };
  $scope.decreaseItemCount = function(item) {
    if (item.quantity > 0) {
      item.quantity--;
    }
};

$scope.bettype_tab=1;
$scope.sportstype_tab=1;
$scope.acinfo_tab=1;
$scope.acinfodialoge_tab=1;

$scope.openDefault = function (userpopup) {
    ngDialog.open({
        template: userpopup,
        className: 'ngdialog-theme-default',
		scope: $scope
    });
};
$scope.clickToOpen = function () {
        ngDialog.open({ template: 'popupTmpl.html', className: 'ngdialog-theme-default' });
};

//Angularjs and jquery.datatable with ui.bootstrap and ui.utils
$scope.masterNames = [
        'Jani',
        'Carl',
        'Margareth',
        'Hege',
        'Joe',
        'Gustav',
        'Birgit',
        'Mary',
        'Kai',
        'John',
        'Carla',
        'Joel',
        'Stephen',
        'Stepheni',
        'Kirra',
        'Maria',
   ];

var generateData = function(){
  var arr = [];
  var letterWords = ["alpha","bravo","charlie","daniel","earl","fish","grace","henry","ian","jack","karen","mike","delta","alex","larry","bob","zelda"]
   var ipaddress = ["192.545.33.3","192.545.33.3","192.545.33.3","192.55.4958.3","192.545.33.3","192.45.63.1","192.545.33.3"]
   var smasterstatus = ["Active","Inactive","Closed"]
  for (var i=1;i<60;i++){
    var id = letterWords[Math.floor(Math.random()*letterWords.length)];
    var ipadd = ipaddress[Math.floor(Math.random()*ipaddress.length)];
    var smstatus = smasterstatus[Math.floor(Math.random()*smasterstatus.length)]
    arr.push({"username":id,"type":"User "+i,"lockbetting":id,"logintime":smstatus,"view":id});
  }
  return arr;
}

var sortingOrder = 'name'; //default sort
  // init
  $scope.sortingOrder = sortingOrder;
  $scope.pageSizes = [5,10,25,50];
  $scope.reverse = false;
  $scope.filteredItems = [];
  $scope.groupedItems = [];
  $scope.itemsPerPage = 10;
  $scope.pagedItems = [];
  $scope.currentPage = 0;
  $scope.items = generateData();

  var searchMatch = function (haystack, needle) {
    if (!needle) {
      return true;
    }
    return haystack.toLowerCase().indexOf(needle.toLowerCase()) !== -1;
  };
  
  // init the filtered items
  $scope.search = function () {
    $scope.filteredItems = $filter('filter')($scope.items, function (item) {
      for(var attr in item) {
        if (searchMatch(item[attr], $scope.query))
          return true;
      }
      return false;
    });
    // take care of the sorting order
    if ($scope.sortingOrder !== '') {
      $scope.filteredItems = $filter('orderBy')($scope.filteredItems, $scope.sortingOrder, $scope.reverse);
    }
    $scope.currentPage = 0;
    // now group by pages
    $scope.groupToPages();
  };
  
  // show items per page
  $scope.perPage = function () {
    $scope.groupToPages();
  };
  
  // calculate page in place
  $scope.groupToPages = function () {
    $scope.pagedItems = [];
    
    for (var i = 0; i < $scope.filteredItems.length; i++) {
      if (i % $scope.itemsPerPage === 0) {
        $scope.pagedItems[Math.floor(i / $scope.itemsPerPage)] = [ $scope.filteredItems[i] ];
      } else {
        $scope.pagedItems[Math.floor(i / $scope.itemsPerPage)].push($scope.filteredItems[i]);
      }
    }
  };
  
   $scope.deleteItem = function (idx) {
        var itemToDelete = $scope.pagedItems[$scope.currentPage][idx];
        var idxInItems = $scope.items.indexOf(itemToDelete);
        $scope.items.splice(idxInItems,1);
        $scope.search();
        
        return false;
    };
  
  $scope.range = function (start, end) {
    var ret = [];
    if (!end) {
      end = start;
      start = 0;
    }
    for (var i = start; i < end; i++) {
      ret.push(i);
    }
    return ret;
  };
  
  $scope.prevPage = function () {
    if ($scope.currentPage > 0) {
      $scope.currentPage--;
    }
  };
  
  $scope.nextPage = function () {
    if ($scope.currentPage < $scope.pagedItems.length - 1) {
      $scope.currentPage++;
    }
  };
  
  $scope.setPage = function () {
    $scope.currentPage = this.n;
  };
  
  // functions have been describe process the data for display
  $scope.search();
 
  
  // change sorting order
  $scope.sort_by = function(newSortingOrder) {
    if ($scope.sortingOrder == newSortingOrder)
      $scope.reverse = !$scope.reverse;
    
    $scope.sortingOrder = newSortingOrder;
  };
  
  /******** Login Users ********/
var loginusertable = function(){
  var arr = [];
  var luletterWords = ["alpha","bravo","charlie","daniel","earl","fish","grace","henry","ian","jack","karen","mike","delta","alex","larry","bob","zelda"]
  var mbusername = ["User150","User150","User150","User150","User150","User150","User150","User150","User150","User150","User150","User150","User150","User150","User150","User150","User150"]
  var ipaddress = ["192.545.33.3","192.545.33.3","192.545.33.3","192.55.4958.3","192.545.33.3","192.45.63.1","192.545.33.3"]
  var mbtime = ["20-09-2017 17:54:03","21-09-2017 18:12:08","24-09-2017 23:23:23","18-09-2017 08:54:30"]
  var lucustomertype = ["Client","Master","Super Master"]
  
  for (var i=1;i<60;i++){
    var id = luletterWords[Math.floor(Math.random()*luletterWords.length)];
    var ipadd = ipaddress[Math.floor(Math.random()*ipaddress.length)];
    var time = mbtime[Math.floor(Math.random()*mbtime.length)];
    var usern = mbusername[Math.floor(Math.random()*mbusername.length)];
    var custtype = lucustomertype[Math.floor(Math.random()*lucustomertype.length)];
    arr.push({"username":id,"type":custtype,"lastactivity":time,"logintime":time,"ip":ipadd});
  }
  return arr;
}

var lusortingOrder = 'luname'; //default sort
// init
$scope.lusortingOrder = lusortingOrder;
$scope.lupageSizes = [5,10,25,50];
$scope.lureverse = false;
$scope.lufilteredItems = [];
$scope.lugroupedItems = [];
$scope.luitemsPerPage = 100;
$scope.lupagedItems = [];
$scope.lucurrentPage = 0;
$scope.luitems = loginusertable();

var lusearchMatch = function (haystack, needle) {
    if (!needle) {
      return true;
    }
    return haystack.toLowerCase().indexOf(needle.toLowerCase()) !== -1;
};
  
  // init the filtered items
$scope.lusearch = function () {
$scope.lufilteredItems = $filter('filter')($scope.luitems, function (luitem) {
      for(var attr in luitem) {
        if (lusearchMatch(luitem[attr], $scope.query))
          return true;
      }
      return false;
});
// take care of the sorting order
if ($scope.lusortingOrder !== '') {
$scope.lufilteredItems = $filter('orderBy')($scope.lufilteredItems, $scope.lusortingOrder, $scope.lureverse);
}
$scope.lucurrentPage = 0;
// now group by pages
$scope.lugroupToPages();
};
  
  // show items per page
  $scope.luperPage = function () {
    $scope.lugroupToPages();
  };
  
  // calculate page in place
  $scope.lugroupToPages = function () {
    $scope.lupagedItems = [];
    
    for (var i = 0; i < $scope.lufilteredItems.length; i++) {
      if (i % $scope.luitemsPerPage === 0) {
        $scope.lupagedItems[Math.floor(i / $scope.luitemsPerPage)] = [ $scope.lufilteredItems[i] ];
      } else {
        $scope.lupagedItems[Math.floor(i / $scope.luitemsPerPage)].push($scope.lufilteredItems[i]);
      }
    }
  };

$scope.lurange = function (start, end) {
    var ret = [];
    if (!end) {
      end = start;
      start = 0;
    }
    for (var i = start; i < end; i++) {
      ret.push(i);
    }
    return ret;
  };
  
  $scope.luprevPage = function () {
    if ($scope.lucurrentPage > 0) {
      $scope.lucurrentPage--;
    }
  };
  
  $scope.lunextPage = function () {
    if ($scope.lucurrentPage < $scope.lupagedItems.length - 1) {
      $scope.lucurrentPage++;
    }
  };
  
  $scope.lusetPage = function () {
    $scope.lucurrentPage = this.n;
  };
  
  // functions have been describe process the data for display
  $scope.lusearch();
 
  
  // change sorting order
  $scope.lusort_by = function(newluSortingOrder) {
    if ($scope.lusortingOrder == newluSortingOrder)
      $scope.lureverse = !$scope.lureverse;
    
    $scope.lusortingOrder = newluSortingOrder;
  };



/******** Matched Bets ********/
var matchedbetstable = function(){
  var arr = [];
  var mbletterWords = ["alpha","bravo","charlie","daniel","earl","fish","grace","henry","ian","jack","karen","mike","delta","alex","larry","bob","zelda"]
  var mbusername = ["User150","User150","User150","User150","User150","User150","User150","User150","User150","User150","User150","User150","User150","User150","User150","User150","User150"]
  var mbselection = ["1st Wicket Aus","6 Over Ind","100 Run First Inning","Fastest Fifty of the Match"]
  var mbodds = ["70","39","60","100","150","200"]
  var mbbacklay = ["Back","Lay","No"]
  var mbamount = ["270.00","340.00","4500.00","7648.00"]
  var ipaddress = ["192.545.33.3","192.545.33.3","192.545.33.3","192.55.4958.3","192.545.33.3","192.45.63.1","192.545.33.3"]
  var mbtime = ["20-09-2017 17:54:03","21-09-2017 18:12:08","24-09-2017 23:23:23","18-09-2017 08:54:30"]
  var mbmatch = ["England vs New Zealand","India vs Australia","Srilanka vs Pakistan","Germany vs Bangladesh","Chelsea vs Manchester United","Arsenal vs Liverpool","Gujarat Lions vs Delhi Daredevils"]
  var mbparent = ["Master"]
  var mbsuperparent = ["SuperMaster"]
  for (var i=1;i<60;i++){
    var id = mbletterWords[Math.floor(Math.random()*mbletterWords.length)];
    var usern = mbusername[Math.floor(Math.random()*mbusername.length)];
    var mbsel = mbselection[Math.floor(Math.random()*mbselection.length)];
    var odd = mbodds[Math.floor(Math.random()*mbodds.length)];
    var backlay = mbbacklay[Math.floor(Math.random()*mbbacklay.length)];
    var amt = mbamount[Math.floor(Math.random()*mbamount.length)];
    var ipadd = ipaddress[Math.floor(Math.random()*ipaddress.length)];
    var match = mbmatch[Math.floor(Math.random()*mbmatch.length)];
    var time = mbtime[Math.floor(Math.random()*mbtime.length)];
    var parent = mbparent[Math.floor(Math.random()*mbparent.length)];
    var superparent = mbsuperparent[Math.floor(Math.random()*mbsuperparent.length)];

    arr.push({"time":id,"parent":superparent,"account":usern,"game":match,"selection":mbsel,"odds":odd,"backlay":backlay,"amount":amt,"by":usern,"time":time,"ip":ipadd});
  }
  return arr;
}

var mbsortingOrder = 'luname'; //default sort
// init
$scope.mbsortingOrder = lusortingOrder;
$scope.mbpageSizes = [5,10,25,50];
$scope.mbreverse = false;
$scope.mbfilteredItems = [];
$scope.mbgroupedItems = [];
$scope.mbitemsPerPage = 100;
$scope.mbpagedItems = [];
$scope.mbcurrentPage = 0;
$scope.mbitems = matchedbetstable();

var mbsearchMatch = function (haystack, needle) {
    if (!needle) {
      return true;
    }
    return haystack.toLowerCase().indexOf(needle.toLowerCase()) !== -1;
};
  
  // init the filtered items
$scope.mbsearch = function () {
$scope.mbfilteredItems = $filter('filter')($scope.mbitems, function (mbitem) {
      for(var attr in mbitem) {
        if (mbsearchMatch(mbitem[attr], $scope.query))
          return true;
      }
      return false;
});
// take care of the sorting order
if ($scope.mbsortingOrder !== '') {
$scope.mbfilteredItems = $filter('orderBy')($scope.mbfilteredItems, $scope.mbsortingOrder, $scope.mbreverse);
}
$scope.mbcurrentPage = 0;
// now group by pages
$scope.mbgroupToPages();
};
  
  // show items per page
  $scope.mbperPage = function () {
    $scope.mbgroupToPages();
  };
  
  // calculate page in place
  $scope.mbgroupToPages = function () {
    $scope.mbpagedItems = [];
    
    for (var i = 0; i < $scope.mbfilteredItems.length; i++) {
      if (i % $scope.mbitemsPerPage === 0) {
        $scope.mbpagedItems[Math.floor(i / $scope.mbitemsPerPage)] = [ $scope.mbfilteredItems[i] ];
      } else {
        $scope.mbpagedItems[Math.floor(i / $scope.mbitemsPerPage)].push($scope.mbfilteredItems[i]);
      }
    }
  };

$scope.mbrange = function (start, end) {
    var ret = [];
    if (!end) {
      end = start;
      start = 0;
    }
    for (var i = start; i < end; i++) {
      ret.push(i);
    }
    return ret;
  };
  
  $scope.mbprevPage = function () {
    if ($scope.mbcurrentPage > 0) {
      $scope.mbcurrentPage--;
    }
  };
  
  $scope.mbnextPage = function () {
    if ($scope.mbcurrentPage < $scope.mbpagedItems.length - 1) {
      $scope.mbcurrentPage++;
    }
  };
  
  $scope.mbsetPage = function () {
    $scope.mbcurrentPage = this.n;
  };
  
  // functions have been describe process the data for display
  $scope.mbsearch();
 
  
  // change sorting order
  $scope.mbsort_by = function(newmbSortingOrder) {
    if ($scope.mbsortingOrder == newmbSortingOrder)
      $scope.mbreverse = !$scope.mbreverse;
    
    $scope.mbsortingOrder = newmbSortingOrder;
  };

  $scope.activeMenu = 'matchodds';

/******** Master Users ********/
var masterusertable = function(){
  var arr = [];
  var muletterWords = ["Ilyaz","Sandip","Amit","Pratik"]
  var muusername = ["User150","User150","User150","User150","User150","User150","User150","User150","User150","User150","User150","User150","User150","User150","User150","User150","User150"]
  var mumaxprofit = ["1,00,00,000.00"]
  var availablebal = ["10,00,000.00"]
  var exposer = ["10,00,000.00"]
  var status = ["Active","Inactive"]
  var profitloss = ["2000.00","2300.00","4560.50","1200.00","86730.00","23000.00","27560.00","12200.00","56500.00","76700.00"]
  for (var i=1;i<60;i++){
    var id = muletterWords[Math.floor(Math.random()*muletterWords.length)];
    var mp = mumaxprofit[Math.floor(Math.random()*mumaxprofit.length)];
    var ab = availablebal[Math.floor(Math.random()*availablebal.length)];
    var exp = exposer[Math.floor(Math.random()*exposer.length)];
    var un = muusername[Math.floor(Math.random()*muusername.length)];
    var stat = status[Math.floor(Math.random()*status.length)];
    var pl = profitloss[Math.floor(Math.random()*profitloss.length)];

    arr.push({"name":id,"username":un,"coinreference":"2000.00","profitloss":pl,"exposer":exp,"availablebalance":ab,"maxprofitlimit":mp,"lockbetting":id,"status":stat});
  }
  return arr;
}

var musortingOrder = 'muname'; //default sort
// init
$scope.musortingOrder = musortingOrder;
$scope.mupageSizes = [5,10,25,50];
$scope.mureverse = false;
$scope.mufilteredItems = [];
$scope.mugroupedItems = [];
$scope.muitemsPerPage = 100;
$scope.mupagedItems = [];
$scope.mucurrentPage = 0;
$scope.muitems = masterusertable();

var musearchMatch = function (haystack, needle) {
    if (!needle) {
      return true;
    }
    return haystack.toLowerCase().indexOf(needle.toLowerCase()) !== -1;
};
  
  // init the filtered items
$scope.musearch = function () {
$scope.mufilteredItems = $filter('filter')($scope.muitems, function (muitem) {
      for(var attr in muitem) {
        if (musearchMatch(muitem[attr], $scope.muquery))
          return true;
      }
      return false;
});
// take care of the sorting order
if ($scope.musortingOrder !== '') {
$scope.mufilteredItems = $filter('orderBy')($scope.mufilteredItems, $scope.musortingOrder, $scope.mureverse);
}
$scope.mucurrentPage = 0;
// now group by pages
$scope.mugroupToPages();
};
  
  // show items per page
  $scope.muperPage = function () {
    $scope.mugroupToPages();
  };
  
  // calculate page in place
  $scope.mugroupToPages = function () {
    $scope.mupagedItems = [];
    
    for (var i = 0; i < $scope.mufilteredItems.length; i++) {
      if (i % $scope.muitemsPerPage === 0) {
        $scope.mupagedItems[Math.floor(i / $scope.muitemsPerPage)] = [ $scope.mufilteredItems[i] ];
      } else {
        $scope.mupagedItems[Math.floor(i / $scope.muitemsPerPage)].push($scope.mufilteredItems[i]);
      }
    }
  };

$scope.murange = function (start, end) {
    var ret = [];
    if (!end) {
      end = start;
      start = 0;
    }
    for (var i = start; i < end; i++) {
      ret.push(i);
    }
    return ret;
  };
  
  $scope.muprevPage = function () {
    if ($scope.mucurrentPage > 0) {
      $scope.mucurrentPage--;
    }
  };
  
  $scope.munextPage = function () {
    if ($scope.mucurrentPage < $scope.mupagedItems.length - 1) {
      $scope.mucurrentPage++;
    }
  };
  
  $scope.musetPage = function () {
    $scope.mucurrentPage = this.n;
  };
  
  // functions have been describe process the data for display
  $scope.musearch();
 
  
  // change sorting order
  $scope.musort_by = function(newmuSortingOrder) {
    if ($scope.musortingOrder == newmuSortingOrder)
      $scope.mureverse = !$scope.mureverse;
    
    $scope.musortingOrder = newmuSortingOrder;
  };


/******** Matched Bets Popup ********/
var mbpusertable = function(){
  var arr = [];
  var mbpletterWords = ["alpha","bravo","charlie","daniel","earl","fish","grace","henry","ian","jack","karen","mike","delta","alex","larry","bob","zelda"]
  for (var i=1;i<60;i++){
    var id = mbpletterWords[Math.floor(Math.random()*mbpletterWords.length)];


    arr.push({"name":id,"username":id,"coinreference":"2000"+i,"profitloss":"Description of item #"+i,"availablebalance":id,"maxprofitlimit":id,"lockbetting":id,"status":id});
  }
  return arr;
}

var mbpsortingOrder = 'mbpname'; //default sort
// init
$scope.mbpsortingOrder = mbpsortingOrder;
$scope.mbppageSizes = [5,10,25,50];
$scope.mbpreverse = false;
$scope.mbpfilteredItems = [];
$scope.mbpgroupedItems = [];
$scope.mbpitemsPerPage = 100;
$scope.mbppagedItems = [];
$scope.mbpcurrentPage = 0;
$scope.mbpitems = mbpusertable();

var mbpsearchMatch = function (haystack, needle) {
    if (!needle) {
      return true;
    }
    return haystack.toLowerCase().indexOf(needle.toLowerCase()) !== -1;
};
  
  // init the filtered items
$scope.mbpsearch = function () {
$scope.mbpfilteredItems = $filter('filter')($scope.mbpitems, function (mbpitem) {
      for(var attr in mbpitem) {
        if (mbpsearchMatch(mbpitem[attr], $scope.mbpquery))
          return true;
      }
      return false;
});
// take care of the sorting order
if ($scope.mbpsortingOrder !== '') {
$scope.mbpfilteredItems = $filter('orderBy')($scope.mbpfilteredItems, $scope.mbpsortingOrder, $scope.mbpreverse);
}
$scope.mbpcurrentPage = 0;
// now group by pages
$scope.mbpgroupToPages();
};
  
  // show items per page
  $scope.mbpperPage = function () {
    $scope.mbpgroupToPages();
  };
  
  // calculate page in place
  $scope.mbpgroupToPages = function () {
    $scope.mbppagedItems = [];
    
    for (var i = 0; i < $scope.mbpfilteredItems.length; i++) {
      if (i % $scope.mbpitemsPerPage === 0) {
        $scope.mbppagedItems[Math.floor(i / $scope.mbpitemsPerPage)] = [ $scope.mbpfilteredItems[i] ];
      } else {
        $scope.mbppagedItems[Math.floor(i / $scope.mbpitemsPerPage)].push($scope.mbpfilteredItems[i]);
      }
    }
  };

$scope.mbprange = function (start, end) {
    var ret = [];
    if (!end) {
      end = start;
      start = 0;
    }
    for (var i = start; i < end; i++) {
      ret.push(i);
    }
    return ret;
  };
  
  $scope.mbpprevPage = function () {
    if ($scope.mbpcurrentPage > 0) {
      $scope.mbpcurrentPage--;
    }
  };
  
  $scope.mbpnextPage = function () {
    if ($scope.mbpcurrentPage < $scope.mbppagedItems.length - 1) {
      $scope.mbpcurrentPage++;
    }
  };
  
  $scope.mbpsetPage = function () {
    $scope.mbpcurrentPage = this.n;
  };
  
  // functions have been describe process the data for display
  $scope.mbpsearch();
 
  
  // change sorting order
  $scope.mbpsort_by = function(newmbpSortingOrder) {
    if ($scope.mbpsortingOrder == newmbpSortingOrder)
      $scope.mbpreverse = !$scope.mbpreverse;
    
    $scope.mbpsortingOrder = newmbpSortingOrder;
  };
  
  /******** Vertical Buttons Matched/Unmatched Bets ********/
var matchedunmatchedbuttons = function(){
  var arr = [];
  var vmbletterWords = ["alpha","bravo","charlie","daniel","earl","fish","grace","henry","ian","jack","karen","mike","delta","alex","larry","bob","zelda"]
  var vmbusername = ["User150","User150","User150","User150","User150","User150","User150","User150","User150","User150","User150","User150","User150","User150","User150","User150","User150"]
  var vmbselection = ["1st Wicket Aus","6 Over Ind","100 Run First Inning","Fastest Fifty of the Match"]
  var vmbodds = ["70","39","60","100","150","200"]
  var vmbbacklay = ["Back","Lay","No"]
  var vmbamount = ["270.00","340.00","4500.00","7648.00"]
  var vmbipaddress = ["192.545.33.3","192.545.33.3","192.545.33.3","192.55.4958.3","192.545.33.3","192.45.63.1","192.545.33.3"]
  var vmbtime = ["20-09-2017 17:54:03","21-09-2017 18:12:08","24-09-2017 23:23:23","18-09-2017 08:54:30"]
  var vmbmatch = ["England vs New Zealand","India vs Australia","Srilanka vs Pakistan","Germany vs Bangladesh","Chelsea vs Manchester United","Arsenal vs Liverpool","Gujarat Lions vs Delhi Daredevils"]
  var vmbparent = ["Master"]
  var vmbsuperparent = ["SuperMaster"]
  for (var i=1;i<60;i++){
    var id = vmbletterWords[Math.floor(Math.random()*vmbletterWords.length)];
    var usern = vmbusername[Math.floor(Math.random()*vmbusername.length)];
    var mbsel = vmbselection[Math.floor(Math.random()*vmbselection.length)];
    var odd = vmbodds[Math.floor(Math.random()*vmbodds.length)];
    var backlay = vmbbacklay[Math.floor(Math.random()*vmbbacklay.length)];
    var amt = vmbamount[Math.floor(Math.random()*vmbamount.length)];
    var ipadd = vmbipaddress[Math.floor(Math.random()*vmbipaddress.length)];
    var match = vmbmatch[Math.floor(Math.random()*vmbmatch.length)];
    var time = vmbtime[Math.floor(Math.random()*vmbtime.length)];
    var parent = vmbparent[Math.floor(Math.random()*vmbparent.length)];
    var superparent = vmbsuperparent[Math.floor(Math.random()*vmbsuperparent.length)];

    arr.push({"time":id,"parent":superparent,"account":usern,"game":match,"selection":mbsel,"odds":odd,"backlay":backlay,"amount":amt,"by":usern,"time":time,"ip":ipadd});
  }
  return arr;
}

var vmbsortingOrder = 'vmbname'; //default sort
// init
$scope.vmbsortingOrder = vmbsortingOrder;
$scope.vmbpageSizes = [5,10,25,50];
$scope.vmbreverse = false;
$scope.vmbfilteredItems = [];
$scope.vmbgroupedItems = [];
$scope.vmbitemsPerPage = 10;
$scope.vmbpagedItems = [];
$scope.vmbcurrentPage = 0;
$scope.vmbitems = matchedunmatchedbuttons();

var vmbsearchMatch = function (haystack, needle) {
    if (!needle) {
      return true;
    }
    return haystack.toLowerCase().indexOf(needle.toLowerCase()) !== -1;
};
  
  // init the filtered items
$scope.vmbsearch = function () {
$scope.vmbfilteredItems = $filter('filter')($scope.vmbitems, function (vmbitem) {
      for(var attr in vmbitem) {
        if (vmbsearchMatch(vmbitem[attr], $scope.vmbquery))
          return true;
      }
      return false;
});
// take care of the sorting order
if ($scope.vmbsortingOrder !== '') {
$scope.vmbfilteredItems = $filter('orderBy')($scope.vmbfilteredItems, $scope.vmbsortingOrder, $scope.vmbreverse);
}
$scope.vmbcurrentPage = 0;
// now group by pages
$scope.vmbgroupToPages();
};
  
  // show items per page
  $scope.vmbperPage = function () {
    $scope.vmbgroupToPages();
  };
  
  // calculate page in place
  $scope.vmbgroupToPages = function () {
    $scope.vmbpagedItems = [];
    
    for (var i = 0; i < $scope.vmbfilteredItems.length; i++) {
      if (i % $scope.vmbitemsPerPage === 0) {
        $scope.vmbpagedItems[Math.floor(i / $scope.vmbitemsPerPage)] = [ $scope.vmbfilteredItems[i] ];
      } else {
        $scope.vmbpagedItems[Math.floor(i / $scope.vmbitemsPerPage)].push($scope.vmbfilteredItems[i]);
      }
    }
  };

$scope.vmbrange = function (start, end) {
    var ret = [];
    if (!end) {
      end = start;
      start = 0;
    }
    for (var i = start; i < end; i++) {
      ret.push(i);
    }
    return ret;
  };
  
  $scope.vmbprevPage = function () {
    if ($scope.vmbcurrentPage > 0) {
      $scope.vmbcurrentPage--;
    }
  };
  
  $scope.vmbnextPage = function () {
    if ($scope.vmbcurrentPage < $scope.vmbpagedItems.length - 1) {
      $scope.vmbcurrentPage++;
    }
  };
  
  $scope.vmbsetPage = function () {
    $scope.vmbcurrentPage = this.n;
  };
  
  // functions have been describe process the data for display
  $scope.vmbsearch();
 
  
  // change sorting order
  $scope.vmbsort_by = function(newvmbSortingOrder) {
    if ($scope.vmbsortingOrder == newvmbSortingOrder)
      $scope.vmbreverse = !$scope.vmbreverse;
    
    $scope.vmbsortingOrder = newvmbSortingOrder;
  };


/******** Game Management Table ********/
var gamemgttable = function(){
  var arr = [];
  var gmletterWords = ["alpha","bravo","charlie","daniel","earl","fish","grace","henry","ian","jack","karen","mike","delta","alex","larry","bob","zelda"]
  var gmusername = ["User150","User150","User150","User150","User150","User150","User150","User150","User150","User150","User150","User150","User150","User150","User150","User150","User150"]
  var gmselection = ["1st Wicket Aus","6 Over Ind","100 Run First Inning","Fastest Fifty of the Match"]
  var gmodds = ["70","39","60","100","150","200"]
  var gmbacklay = ["Back","Lay","No"]
  var gmamount = ["270.00","340.00","4500.00","7648.00"]
  var gmipaddress = ["192.545.33.3","192.545.33.3","192.545.33.3","192.55.4958.3","192.545.33.3","192.45.63.1","192.545.33.3"]
  var gmtime = ["20-09-2017 17:54:03","21-09-2017 18:12:08","24-09-2017 23:23:23","18-09-2017 08:54:30"]
  var gmmatch = ["England vs New Zealand","India vs Australia","Srilanka vs Pakistan","Germany vs Bangladesh","Chelsea vs Manchester United","Arsenal vs Liverpool","Gujarat Lions vs Delhi Daredevils"]
  var gmparent = ["Master"]
  var gmsuperparent = ["SuperMaster"]
  for (var i=1;i<60;i++){
    var id = gmletterWords[Math.floor(Math.random()*gmletterWords.length)];
    var usern = gmusername[Math.floor(Math.random()*gmusername.length)];
    var mbsel = gmselection[Math.floor(Math.random()*gmselection.length)];
    var odd = gmodds[Math.floor(Math.random()*gmodds.length)];
    var backlay = gmbacklay[Math.floor(Math.random()*gmbacklay.length)];
    var amt = gmamount[Math.floor(Math.random()*gmamount.length)];
    var ipadd = gmipaddress[Math.floor(Math.random()*gmipaddress.length)];
    var match = gmmatch[Math.floor(Math.random()*gmmatch.length)];
    var time = gmtime[Math.floor(Math.random()*gmtime.length)];
    var parent = gmparent[Math.floor(Math.random()*gmparent.length)];
    var superparent = gmsuperparent[Math.floor(Math.random()*gmsuperparent.length)];

    arr.push({"time":id,"parent":superparent,"account":usern,"game":match,"selection":mbsel,"odds":odd,"backlay":backlay,"amount":amt,"by":usern,"time":time,"ip":ipadd});
  }
  return arr;
}

var gmsortingOrder = 'gmname'; //default sort
// init
$scope.gmsortingOrder = gmsortingOrder;
$scope.gmpageSizes = [5,10,25,50];
$scope.gmreverse = false;
$scope.gmfilteredItems = [];
$scope.gmgroupedItems = [];
$scope.gmitemsPerPage = 10;
$scope.gmpagedItems = [];
$scope.gmcurrentPage = 0;
$scope.gmitems = gamemgttable();

var gmsearchMatch = function (haystack, needle) {
    if (!needle) {
      return true;
    }
    return haystack.toLowerCase().indexOf(needle.toLowerCase()) !== -1;
};
  
  // init the filtered items
$scope.gmsearch = function () {
$scope.gmfilteredItems = $filter('filter')($scope.gmitems, function (gmitem) {
      for(var attr in gmitem) {
        if (gmsearchMatch(gmitem[attr], $scope.gmquery))
          return true;
      }
      return false;
});
// take care of the sorting order
if ($scope.gmsortingOrder !== '') {
$scope.gmfilteredItems = $filter('orderBy')($scope.gmfilteredItems, $scope.gmsortingOrder, $scope.gmreverse);
}
$scope.gmcurrentPage = 0;
// now group by pages
$scope.gmgroupToPages();
};
  
  // show items per page
  $scope.gmperPage = function () {
    $scope.gmgroupToPages();
  };
  
  // calculate page in place
  $scope.gmgroupToPages = function () {
    $scope.gmpagedItems = [];
    
    for (var i = 0; i < $scope.gmfilteredItems.length; i++) {
      if (i % $scope.gmitemsPerPage === 0) {
        $scope.gmpagedItems[Math.floor(i / $scope.gmitemsPerPage)] = [ $scope.gmfilteredItems[i] ];
      } else {
        $scope.gmpagedItems[Math.floor(i / $scope.gmitemsPerPage)].push($scope.gmfilteredItems[i]);
      }
    }
  };

$scope.gmrange = function (start, end) {
    var ret = [];
    if (!end) {
      end = start;
      start = 0;
    }
    for (var i = start; i < end; i++) {
      ret.push(i);
    }
    return ret;
  };
  
  $scope.vmbprevPage = function () {
    if ($scope.vmbcurrentPage > 0) {
      $scope.vmbcurrentPage--;
    }
  };
  
  $scope.vmbnextPage = function () {
    if ($scope.vmbcurrentPage < $scope.vmbpagedItems.length - 1) {
      $scope.vmbcurrentPage++;
    }
  };
  
  $scope.vmbsetPage = function () {
    $scope.vmbcurrentPage = this.n;
  };
  
  // functions have been describe process the data for display
  $scope.vmbsearch();
   
  // change sorting order
  $scope.vmbsort_by = function(newvmbSortingOrder) {
    if ($scope.vmbsortingOrder == newvmbSortingOrder)
      $scope.vmbreverse = !$scope.vmbreverse;
    
    $scope.vmbsortingOrder = newvmbSortingOrder;
  };

$scope.activeMenu = 'matchodds';


/** Development Side Added JS **/ 	

  // Left Side Bar Toggle
  $scope.leftbardisplay = "app-side-opened";
  $scope.toggleLeftbar = function(){
    if ($scope.leftbardisplay === "app-side-opened")
      $scope.leftbardisplay = "app-side-opened app-side-mini";
    else
      $scope.leftbardisplay = "app-side-opened";
  };
    // $scope will allow this to pass between controller and view
	$scope.formData = [];
	
	// process the form
	$scope.processForm = function() {
		$http({
			url: url+'client/addbuttonvalue',
			method: "POST",
			data : $scope.formData
		   }).then(function(data){
				console.log(data);
				if (!data.success) {
					// if not successful, bind errors to error variables
					$scope.errorName = data.errors.name;
					$scope.errorSuperhero = data.errors.superheroAlias;
				} else {
					// if successful, bind success message to message
					$scope.message = data.message;
					$scope.errorName = '';
					$scope.errorSuperhero = '';
				}
		   },function (response){
			//$scope.throwError();
		});
	};

// in controller
$scope.init = function ($data) {
	if($data == 0){	
		//$scope.openDefault('tandcpopup');
		ngDialog.open({
			template: 'tandcpopup',
			className: 'ngdialog-theme-default',
			scope: $scope,
			closeByDocument : false,
			showClose : false
		});
	}
		
};	
	/** Create Super Master Use **/
	$scope.addtandc = {};
	// process the form
	$scope.checktandc = function(){
		/*alert('asdf');
		return false;*/
		
		$scope.ajaxformprocess = true;
		$http({
			url: url+'client/addtandc',
		   }).then(function(responce){
			  window.location.href = url+'client/inplay';
			   console.log(responce);
		   },function(response){
			   
		});
	    return false;
	};
});