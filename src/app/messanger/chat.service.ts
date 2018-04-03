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
  hasConversation: Boolean = false;
  senderDetails: Object = <usersData>{};
  recieverDetais: Object = <usersData>{};
  constructor(private afs: AngularFirestore, private afAuth: AngularFireAuth, public auth: AuthService) { }

  addChat(event: KeyboardEvent, messageText, senderId: string, sender_name: string, reciverId: string, reciver_name: string, conversationId: string) {
    var self = this;
    var timestamp = new Date().getTime();
    var date = new Date();
    var message = {
      message: messageText,
      sender_id: senderId,
      sender_name: sender_name,
      reciver_id: reciverId,
      reciver_name: reciver_name,
      time: timestamp,
      date: date
    }

    if (conversationId) {
      // Create a reference to the SF doc.
      const sfDocRef = self.afs.firestore.collection("conversations").doc(conversationId);
      if (!self.hasConversation) {
        var recieverConversation = <usersData>self.recieverDetais
        var senderConversation = <usersData>self.senderDetails;
        if (recieverConversation && recieverConversation.conversations && recieverConversation.conversations.length) {
          recieverConversation.conversations.push(conversationId);
        } else {
          recieverConversation.conversations = [conversationId]
        }
        if (senderConversation && senderConversation.conversations && senderConversation.conversations.length) {
          senderConversation.conversations.push(conversationId);
        } else {
          senderConversation.conversations = [conversationId];
        }
        self.afs.collection("users").doc(reciverId).update({
          conversations: recieverConversation.conversations
        })
        self.afs.collection("users").doc(senderId).update({
          conversations: senderConversation.conversations
        })
        sfDocRef.set({ messages: [message] });
        return;
      } 
      // Uncomment to initialize the doc.
      this.afs.firestore.runTransaction(transaction =>
        // This code may get re-run multiple times if there are conflicts.
        transaction.get(sfDocRef)
          .then(sfDoc => {
            var newPopulation = sfDoc.data().messages;
            newPopulation.push(message)
            transaction.update(sfDocRef, { messages: sfDoc.data().messages = newPopulation });
          })).then(() => console.log("Transaction successfully committed!"))
        .catch(error => console.log("Transaction failed: ", error));
    }
  }
  getConversationId(sender, reciver) {
    this.senderDetails = sender;
    this.recieverDetais = reciver;
    var conversationArray = _.intersectionWith(sender.conversations, reciver.conversations, _.isEqual);
    if (conversationArray[0]) {
      this.hasConversation = true;
      return conversationArray[0];
    } else {
      this.hasConversation = false;
      return new Date().getTime().toString()
    }
  }
  makeConversation(conversations) {
    var messages = [];
    messages = _.map(_.sortBy(conversations, 'time'), (item) => {
      if (item.sender_id === this.afAuth.auth.currentUser.providerData[0].uid) {
        item.prefix = "-right"
      }
      return item;
    });
    return messages;
  }
}
