import { ChatService } from './../chat.service';
import { Component, OnInit, OnChanges, Input, SimpleChanges, SimpleChange } from '@angular/core';
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
  conversations = []
  conversationId = new Subject();
  constructor(private afs: AngularFirestore, private afAuth: AngularFireAuth, public auth: AuthService, public chatservice: ChatService) { 
    this.conversationId.subscribe(conversation => {
      this.conversation = conversation.toString();
      if(this.conversation){
        var conversations = []
        this.afs.collection("conversations").doc(this.conversation).collection('messages').snapshotChanges().map(actions => {
          return actions.map(a => {
            const data = a.payload.doc.data();
            const id = a.payload.doc.id;
            return { id, ...data };
          });
        }).subscribe((querySnapshot) => {
            querySnapshot.forEach((doc) => {
                conversations.push(doc);
            });
            this.makeConversation(conversations);
            conversations=[]
        });
      }
    })
  }

  ngOnInit() {
    
  }
  ngOnChanges(changes: SimpleChanges) {
    var self = this;
    for (let propName in changes) {  
      if(propName !==  'selectedChat'){
        return;
      }
      if(self.selectedChat){
        self.auth.usersData.subscribe(user => {
          var selecteduser = <usersData> self.selectedChat;
          var sene= <usersData> self.selectedChat;
          if(user && sene){
            this.afs.doc('users/'+sene.uid).valueChanges().subscribe(item =>{
              sene = <usersData>item;
              self.conversationId.next(self.chatservice.getConversationId(user, sene))
            });
          }
          self.conversationId.next(self.chatservice.getConversationId(user, sene))
        });
        $('.popup-chat-responsive').toggleClass('open-chat');
      }
    }
  }
  makeConversation(conversations){
    this.conversations =  _.map(_.sortBy(conversations, 'time'), (item) => {
         if(item.sender_id === this.afAuth.auth.currentUser.providerData[0].uid){
           item.prefix  = "-right"
         }
         return item;
     });
     console.log(this.conversations)
   }
 
  onSubmit(event: KeyboardEvent, textarea: HTMLInputElement) {
    var sene= <usersData> this.selectedChat;
    if (event.keyCode === 13 && this.conversation) {
      if(!textarea.value.match("^\\s+$")){
        this.chatservice.addChat(event, textarea.value,this.afAuth.auth.currentUser.providerData[0].uid,sene.uid, this.conversation);
        textarea.value = "";
      } else {
        textarea.required = true;
      }
    }
  }
}
  
