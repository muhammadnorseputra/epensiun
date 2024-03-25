// Uri Segement
var $host = window.location.origin == 'http://localhost';
if ($host || window.location.origin == 'https://bkpsdm.balangankab.go.id') {
    var _uri = `${window.location.origin}/epensiun`;
} else {
    var _uri = `${window.location.origin}`;
}
var _uriSegment = window.location.pathname.split('/');
console.log('Location Origin', _uri);
console.log(_uriSegment);
    
// Params
var queryString = window.location.search;
var urlParams = new URLSearchParams(queryString);
console.log('Params', urlParams);