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
interface message {
  messages:Array<{}>
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
    var self = this;
    var conversations = [];
    self.conversationId.subscribe(conversation => {
      self.conversation = conversation.toString();
      if(self.conversation){
        this.afs.doc('conversations/'+self.conversation).valueChanges().subscribe(item =>{
          var message = <message>item;
          this.conversations =  this.chatservice.makeConversation(message.messages);
        });
      }
    })
  }

  ngOnInit() {
    
  }
  ngOnChanges(changes: SimpleChanges) {
    var self = this;
    for (let propName in changes) {  
      if(propName ==  'isOpened'){
        if(!self.isOpened) {
          self.conversations = [];
        }
      }
      if(propName !==  'selectedChat' && propName !==  'isOpened'){
        return;
      }
      if(self.selectedChat){
        $('.popup-chat-responsive').toggleClass('open-chat');
        self.auth.usersData.subscribe(user => {
          var selecteduser = <usersData> self.selectedChat;
          var sene= <usersData> self.selectedChat;
          if(user && sene){
            this.afs.doc('users/'+sene.uid).valueChanges().subscribe(item =>{
              sene = <usersData>item;
              self.conversationId.next(self.chatservice.getConversationId(user, sene))
            });
          }
        });
      }
    }
  }
 
  onSubmit(event: KeyboardEvent, textarea: HTMLInputElement) {
    var sene= <usersData> this.selectedChat;
    if (event.keyCode === 13 && this.conversation) {
      if(!textarea.value.match("^\\s+$")){
        this.chatservice.addChat(event, textarea.value,this.afAuth.auth.currentUser.providerData[0].uid, this.afAuth.auth.currentUser.providerData[0].displayName,sene.uid,sene.displayName, this.conversation);
        textarea.value = "";
      } else {
        textarea.required = true;
      }
    }
  }
}
  
