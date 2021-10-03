var mongoose = require('mongoose');
var passportAuth = require('../config/passportAuth');
var utile = require('utile')
//var passport = require('passport');
//var config = require('../config/key');
//require('../config/passportAuth')(passport);

var express = require('express');
var jwt = require('jsonwebtoken');
//upload file
var formidable = require('formidable');
var path = require('path');
var fs = require('fs');

var router = express.Router();
var Products = require("../models/products");
/* api*/
router.post('/new_product', function(req, res){

  // create an incoming form object
  var form = new formidable.IncomingForm();
  
    // specify that we want to allow the user to upload multiple files in a single request
    form.multiples = true;
    form.keepExtensions = true
    // store all uploads in the /uploads directory
    form.uploadDir = path.join(__dirname, '../public/uploads');   
    //var fields = [];
    var fields = {};
    form.on('field', function (name, value) { 
        //console.log(name);
        //if (Array.isArray(name)) {
        if (name instanceof Array){

            console.log("f="+fields[name] );
            fields[name] = [ fields[name] ];
            fields[name].push(value);
           
       }else{
        console.log(name);
            fields[name] = value;
       }

        //fields[name] = value;
        /*if(name=="category[]"){
            console.log(value);
        }*/
        
        /* if (fields.hasOwnProperty(name)) {
            if (!(fields[name] instanceof Array)) {
                console.log(fields[name] );
                fields[name] = [ fields[name] ];
                }
                fields[name].push(value);
               
           }else{
                fields[name] = value;
           }*/

   });
   
    form.on('fileBegin', function (name, file) {
      const [fileName, fileExt] = file.name.split('.')
      file.path = path.join(form.uploadDir, `${fileName}.${fileExt}`)
      fields["file_name"] = `${fileName}.${fileExt}`;
   })
   
    //Call back at the end of the form.
   form.on('end', function () { 
   // req.body = utile.mixin(req.body, fields)
      //console.log(req.body.children[0].child_name)
      
      save(fields,res);
   });
   form.parse(req);
   
});

//router.post('/products', passport.authenticate('jwt', { session: false}), function(req, res){ 
   router.post('/products', passportAuth.isJwtAuthenticated, function(req, res){ 
    var token = getToken(req.headers);
    if (token){
        Products.products ({},
            function(err,data) {
                if(err) {
                    res.json({ save : "FAIL", error: err});
                } else {                
                    res.json({ list : data});
                }
            });
    }
    
});

const save = function(req, res) {    
  //urllencode // notes.create (req.body.productName, req.body.specialpoint, req.body.discription,req.body.category,req.body.price,
  //console.log(req.fields.productName);
  //formdata
  //console.log(req['category']);
  return  res.json({ save : "SUCCESS", error: ""}); 
  Products.create (req['productName'], req['specialpoint'], req['discription'],req['category'],req['price'],req['file_name'],
  function(err,data) {
           if(err) {
               res.json({ save : "FAIL", error: err});
           } else {        
               res.json({ save : "SUCCESS", error: ""}); 
              
           }
       });
}

getToken = function (headers) {
    if (headers && headers.authorization) {
      var parted = headers.authorization.split(' ');
      if (parted.length === 2) {
        return parted[1];
      } else {
        return null;
      }
    } else {
      return null;
    }
  };


module.exports = router;
