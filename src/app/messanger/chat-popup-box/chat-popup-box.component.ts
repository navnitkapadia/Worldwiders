import { ChatService } from './../chat.service';
import { Component, OnInit, OnChanges, Input, SimpleChanges } from '@angular/core';
import { Subject } from 'rxjs/Subject';
import { AngularFirestore, AngularFirestoreCollection, AngularFirestoreDocument } from 'angularfire2/firestore';
import { AngularFireAuth } from 'angularfire2/auth';
import * as _ from "lodash";
import { AuthService } from '../../login/auth.service';
declare var $:any;
interface usersData {
  uid: string;
  email: string;
  displayName?: string;
  conversations;
}
@Component({
  selector: 'app-chat-popup-box',
  templateUrl: './chat-popup-box.component.html',
  styleUrls: ['./chat-popup-box.component.css']
})
export class ChatPopupBoxComponent implements OnInit, OnChanges {
  @Input() selectedChat: Object;
  @Input() isOpened:boolean;
  conversation = "";
  user:Object = {}
  selecteduser:Object = {};
  conversationId = new Subject();
  constructor(private afs: AngularFirestore, private afAuth: AngularFireAuth, public auth: AuthService, public chatservice: ChatService) { 
    
  }

  ngOnInit() {
    
  }
  ngOnChanges(changes: SimpleChanges) {
    this.conversationId.subscribe(conversation => {
      this.conversation = conversation.toString();
    })
    this.auth.usersData.subscribe(user => {
      
      this.selecteduser = <usersData> this.selectedChat;
      var sene= <usersData> this.selectedChat;
      if(user && user.conversations && sene &&  sene.conversations){
        this.conversationId.next(this.chatservice.getConversationId(user.conversations, sene.conversations))
        return;
      }else {
        this.conversationId.next(new Date().getTime().toString())
      }
    });
    if(this.selectedChat){
      $('.popup-chat-responsive').toggleClass('open-chat');
    }
    console.log(this.conversation);
    if(this.conversation){
      this.afs.collection("conversations").doc(this.conversation).collection('messages').snapshotChanges().map(actions => {
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
    var sene= <usersData> this.selectedChat;
    if (event.keyCode === 13 && this.conversation) {
      this.chatservice.addChat(event, textarea.value, sene.uid,this.afAuth.auth.currentUser.providerData[0].uid, this.conversation);
    }
  }
}
  
