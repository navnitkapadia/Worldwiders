import { AuthService } from './../login/auth.service';
import { AngularFirestore } from 'angularfire2/firestore';
import { ChatService } from './chat.service';
import { Component, OnInit } from '@angular/core';
import { jsonEval } from '@firebase/util';
import * as _ from "lodash";

@Component({
  selector: 'app-messanger',
  templateUrl: './messanger.component.html',
  styleUrls: ['./messanger.component.css']
})
export class MessangerComponent implements OnInit {
  conversations = [];
  prepareConversations = [];
  constructor(public chatservice: ChatService, private afs: AngularFirestore, public auth: AuthService) {
    
  }

  ngOnInit() {
    var self = this;
    var conversations= [];
    var usersConversations = [];
    this.auth.usersData.subscribe(user =>{
      usersConversations = user.conversations;
      this.afs.collection("conversations").ref.get().then(function(querySnapshot) {
        querySnapshot.forEach(function(doc) {
          if(usersConversations.includes(doc.id)){
            conversations.push({
              docId: doc.id,
              conversations: doc.data()
            })
          }
        });
        self.conversations = conversations; 
        self.prepareConversations = _.map(self.conversations , function(value) {
            var conversationWithId = ""
            var conversationWith = "";
            var lastMessageObj = value.conversations.messages[value.conversations.messages.length -1];

            if(lastMessageObj.sender_id === '1526701457437713'){
              conversationWithId = lastMessageObj.reciver_id;
              conversationWith = lastMessageObj.reciver_name
            }else {
              conversationWithId = lastMessageObj.sender_id;
              conversationWith = lastMessageObj.sender_name
            }
            var obj = {
              "conversationId": value.docId,
              "conversationWithId": conversationWithId,
              "conversationWith": conversationWith,
              "lastMessage": lastMessageObj.message,
              "time": lastMessageObj.time
            }
            return obj;
          });
      });
    });
  }

  openConversation(id){
    var self = this;
    var conversation =_.map(self.conversations , function(value) {
      if(id === value.docId){
        return value.conversations.messages;
      }
    });
    console.log(_.compact(conversation));
    self.conversations = this.chatservice.makeConversation(_.compact(conversation));
  }
}
