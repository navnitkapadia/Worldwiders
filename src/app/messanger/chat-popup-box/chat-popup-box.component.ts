import { ChatService } from './../chat.service';
import { Component, OnInit, OnChanges, Input, SimpleChanges } from '@angular/core';
import { Subject } from 'rxjs/Subject';
import { AngularFirestore, AngularFirestoreCollection, AngularFirestoreDocument } from 'angularfire2/firestore';
import { AngularFireAuth } from 'angularfire2/auth';
import * as _ from "lodash";
import { AuthService } from '../../login/auth.service';
export interface User {
  uid: string;
  email: string;
  displayName?: string;
}
declare var $:any;
@Component({
  selector: 'app-chat-popup-box',
  templateUrl: './chat-popup-box.component.html',
  styleUrls: ['./chat-popup-box.component.css']
})
export class ChatPopupBoxComponent implements OnInit, OnChanges {
  @Input() selectedChat: string;
  @Input() isOpened:boolean;
  conversationId:string;
  conversations = [];
  array1 = [];
  array2  =  [];
  senderId$ = new Subject<string>();
  constructor(private afs: AngularFirestore, private afAuth: AngularFireAuth, public auth: AuthService, public chatservice: ChatService) { 
    
  }

  ngOnInit() {
    
  }
  makeConversation(){
   this.conversations =  _.map(_.sortBy(_.concat(this.array1,this.array2), 'time'), (item) => {
        if(item.sender_id === this.afAuth.auth.currentUser.providerData[0].uid){
          item.prefix  = "-right"
        }
        return item;
    });
    console.log(this.conversations);
  }
  ngOnChanges(changes: SimpleChanges) {
    var sender;
    var reciver;
    this.senderId$.subscribe(value => {
      if(sender && reciver){
        var conversationArray = _.intersectionWith(sender , reciver, _.isEqual);
        if(conversationArray[0]){
          this.conversationId =  conversationArray[0];
        }else{
          this.conversationId = new Date().getTime().toString();
        }
      }
    })
    if(this.selectedChat){
      $('.popup-chat-responsive').toggleClass('open-chat');
    }
    
    if(this.afAuth.auth.currentUser.providerData[0].uid && this.selectedChat){
      // Regular Subject
      this.afs.collection("users").doc(this.selectedChat).ref.get().then(function (doc) {
        if (doc.exists) {
          reciver = doc.data().conversations,
          this.senderId$.next(doc.data().email);
        } else {
          console.log("No such document!");
        }
      }).catch(function (error) {
        console.log("Error getting document:: from chat service", error);
      });
      this.afs.collection("users").doc(this.afAuth.auth.currentUser.providerData[0].uid).ref.get().then(function (doc) {
        if (doc.exists) {
          sender = doc.data().conversations;
          this.senderId$.next(doc.data().email);
        } else {
          console.log("No such document!");
        }
      }).catch(function (error) {
        console.log("Error getting document:: from chat service", error);
      });
    }
    if(this.conversationId){
      this.afs.collection("messages").doc(this.conversationId).collection('messages').snapshotChanges().map(actions => {
        return actions.map(a => {
          const data = a.payload.doc.data();
          const id = a.payload.doc.id;
          return { id, ...data };
        });
      }).subscribe((querySnapshot) => {
          querySnapshot.forEach((doc) => {
              console.log(doc); 
          });
      });
    }
  
  }
  onSubmit(event: KeyboardEvent, textarea: HTMLInputElement) {
    if (event.keyCode === 13) {
      this.chatservice.addChat(event, textarea.value, this.selectedChat, this.afAuth.auth.currentUser.providerData[0].uid, this.conversationId);
    }
  }
}
  
