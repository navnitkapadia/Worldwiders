import { Subject } from 'rxjs/Subject';
import { AuthService } from './../login/auth.service';
import { AngularFireAuth } from 'angularfire2/auth';
import { AngularFirestore } from 'angularfire2/firestore';
import { Injectable } from '@angular/core';
import * as _ from "lodash";
@Injectable()
export class ChatService {
  senderConversation: string;
  reciverConversation: string;
  constructor(private afs: AngularFirestore, private afAuth: AngularFireAuth, public auth: AuthService) { }

  addChat(event: KeyboardEvent, messageText, senderId: string, reciverId: string, conversationId: string) {
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
      this.afs.collection("conversations").doc(conversationId).collection('messages').add(message)
        .catch(function (error) {
          console.error("Error writing document:: from chat service ", error);
        });
    } else {
      const conversationId = new Date().getTime().toString();
      this.afs.collection("conversations").doc(conversationId).collection('messages').add(message)
        .catch(function (error) {
          console.error("Error writing document:: from chat service", error);
        });

      this.afs.collection("users").doc(reciverId).update({
        conversations: [conversationId]
      })
      this.afs.collection("users").doc(senderId).update({
        conversations: [conversationId]
      })
    }
  }

}



