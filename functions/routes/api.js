const express = require('express');
const router = express.Router();
const admin = require("../db-config/db-config");
var db = admin.firestore();
var _ = require('lodash');

router.post('/user-suggetions', (req, res) => {
  res.status(200).send(getFriendSuggetions(req.body.userId));
});

getFriendSuggetions = (userId)=>{
  var usersList = [];
 db.collection('users').get().then(snapshot => {
      snapshot.forEach(doc => {
            usersList.push({
              userId: doc.id,
              data: doc.data()
          });
      });
  })
  .catch(err => {
      console.log('Error getting documents', err);
  });
  console.log(JSON.stringify(usersList))
  var foundedUser = _.find(usersList, {'userId': userId});
  console.log(JSON.stringify(foundedUser))
  var friendSuggtions = _.filter(usersList, (item)=>{
      if(foundedUser.data.friends.includes(item.docId)){
          return true;
      }
      return false;
  })
  JSON.stringify(friendSuggtions);
  return friendSuggtions;
}
module.exports = router;