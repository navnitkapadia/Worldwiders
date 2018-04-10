import { AngularFireAuth } from 'angularfire2/auth';
import { AuthService } from './../login/auth.service';
import { AngularFirestore } from 'angularfire2/firestore';
import { ChatService } from './chat.service';
import { Component, OnInit } from '@angular/core';
import { jsonEval } from '@firebase/util';
import * as _ from "lodash";

interface message {
  messages: Array<{}>
}
interface converationDetail {
  conversationId: string;
  displayName: string;
  userid: string;
}
@Component({
  selector: 'app-messanger',
  templateUrl: './messanger.component.html',
  styleUrls: ['./messanger.component.css']
})
export class MessangerComponent implements OnInit {
  conversations = [];
  prepareConversations = [];
  openedConversationDetails = <converationDetail>{};
  constructor(public chatservice: ChatService, private afAuth: AngularFireAuth, private afs: AngularFirestore, public auth: AuthService) {

  }

  ngOnInit() {
    var self = this;
    this.auth.usersData.subscribe(user => {
      var usersConversations = [];
      usersConversations = user.conversations;
      console.log(usersConversations)
      this.afs.collection("conversations").ref.get().then(function (querySnapshot) {
        var conversations = [];
        querySnapshot.forEach(function (doc) {
          if (usersConversations.includes(doc.id)) {
            conversations.push({
              docId: doc.id,
              conversations: doc.data()
            })
          }
        });
        self.prepareConversations = [];
        self.prepareConversations = _.map(conversations, function (value) {
          var conversationWithId = ""
          var conversationWith = "";
          var lastMessageObj = value.conversations.messages[value.conversations.messages.length - 1];
          if (lastMessageObj.sender_id === self.afAuth.auth.currentUser.providerData[0].uid) {
            conversationWithId = lastMessageObj.reciver_id;
            conversationWith = lastMessageObj.reciver_name
          } else {
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
        if (Object.keys(self.openedConversationDetails).length === 0 && self.prepareConversations[0] && self.prepareConversations[0].conversationId) {
          self.openConversation(self.prepareConversations[0].conversationId)
        }
      });
    });
  }

  openConversation(id) {
    var self = this;
    var obj = _.find(this.prepareConversations, { conversationId: id })
    this.openedConversationDetails = {
      conversationId: id,
      displayName: obj.conversationWith,
      userid: obj.conversationWithId
    }
    this.afs.doc('conversations/' + id).valueChanges().subscribe(item => {
      var message = <message>item;
      self.conversations = message.messages;
    });
  }
  onSubmit(event: KeyboardEvent, textarea: HTMLInputElement) {
    if (event.keyCode === 13 && this.openedConversationDetails.conversationId) {
      if (!textarea.value.match("^\\s+$")) {
        this.chatservice.addChat(event, textarea.value, this.afAuth.auth.currentUser.providerData[0].uid, this.afAuth.auth.currentUser.providerData[0].displayName, this.openedConversationDetails.userid, this.openedConversationDetails.displayName, this.openedConversationDetails.conversationId);
        textarea.value = "";
      } else {
        textarea.required = true;
      }
    }
  }
}
