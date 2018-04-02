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
            conversations.push(doc.data())
          }
        });
        self.conversations = conversations; 
        // _.forEach(self.conversations, function(value) {
        //   console.log(value.messages.length);
        //   console.log(value.messages[value.messages.length - 1])
        // });
        console.log(self.conversations, JSON.stringify(self.conversations))
      });
    });
  }
}
