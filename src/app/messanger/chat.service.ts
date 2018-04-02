import { Subject } from 'rxjs/Subject';
import { AuthService } from './../login/auth.service';
import { AngularFireAuth } from 'angularfire2/auth';
import { AngularFirestore, AngularFirestoreDocument } from 'angularfire2/firestore';
import { Injectable } from '@angular/core';
import * as _ from "lodash";
interface usersData {
  uid: string;
  email: string;
  displayName?: string;
  conversations;
}
@Injectable()
export class ChatService {
  conversationID: string;
  hasConversation:Boolean = false;
  senderDetails:Object =  {};
  recieverDetais:Object = {};
  constructor(private afs: AngularFirestore, private afAuth: AngularFireAuth, public auth: AuthService) { }

  addChat(event: KeyboardEvent, messageText, senderId: string, reciverId: string, conversationId: string) {
    var self = this;
    var timestamp = new Date().getTime();
    var date = new Date();
    var message = {
      message: messageText,
      sender_id: senderId,
      reciver_id: reciverId,
      time: timestamp,
      date: date
    }

    if (conversationId) {
      this.afs.collection("conversations").doc(conversationId).collection('messages').add(message).then(function(){
        if(!self.hasConversation){
          var recieverConversation = <usersData> self.recieverDetais
          var senderConversation =  <usersData> self.senderDetails;
          if(recieverConversation && recieverConversation.conversations && recieverConversation.conversations.length){
            recieverConversation.conversations.push(conversationId);
          } else{
            recieverConversation.conversations  = [conversationId]
          }
          if(senderConversation && senderConversation.conversations && senderConversation.conversations.length){
            senderConversation.conversations.push(conversationId);
          } else {
            senderConversation.conversations  = [conversationId];
          }
          self.afs.collection("users").doc(reciverId).update({
            conversations: recieverConversation.conversations
          })
          self.afs.collection("users").doc(senderId).update({
            conversations: senderConversation.conversations
          })
        }
      }).catch(function (error) {
          console.log("Error writing document:: from chat service ", error);
        });
    }
  }
  getConversationId(sender, reciver){
    this.senderDetails = sender;
    this.recieverDetais = reciver;
    var conversationArray = _.intersectionWith(sender.conversations, reciver.conversations, _.isEqual);
        if(conversationArray[0]){
           this.hasConversation = true;
          return conversationArray[0];
          
        }else{
          this.hasConversation = false;
          return new Date().getTime().toString()
        }
  }

}



