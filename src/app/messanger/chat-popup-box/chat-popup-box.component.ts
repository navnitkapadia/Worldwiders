import { Component, OnInit, OnChanges, Input, SimpleChanges } from '@angular/core';
import { Subject } from 'rxjs/Subject';
import { AngularFirestore, AngularFirestoreCollection } from 'angularfire2/firestore';
import { AngularFireAuth } from 'angularfire2/auth';
import * as _ from "lodash";

declare var $:any;
@Component({
  selector: 'app-chat-popup-box',
  templateUrl: './chat-popup-box.component.html',
  styleUrls: ['./chat-popup-box.component.css']
})
export class ChatPopupBoxComponent implements OnInit, OnChanges {
  @Input() selectedChat: string;
  @Input() isOpened:boolean;
  conversations = [];
  array1 = [];
  array2  =  [];
  senderId$ = new Subject<string>();
  reciverId$ = new Subject<string>();
  constructor(private afs: AngularFirestore, private afAuth: AngularFireAuth) { 
    const queryObservable = this.senderId$.switchMap(id =>
      afs.collection('messages', ref => ref.where('sender_id', '==', id).where('reciver_id', '==', this.afAuth.auth.currentUser.providerData[0].uid)).valueChanges());
    queryObservable.subscribe(queriedItems => {
      this.makeConversation();
       this.array1 = queriedItems;
    });
    const queryObservable1 = this.senderId$.switchMap(id =>
      afs.collection('messages', ref => ref.where('reciver_id', '==', id).where('sender_id', '==', this.afAuth.auth.currentUser.providerData[0].uid)).valueChanges());
      queryObservable1.subscribe(queriedItems1 => {
        this.array2 = queriedItems1;
        this.makeConversation();
    });
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
    if(this.selectedChat){
      this.senderId$.next(this.selectedChat);
      this.reciverId$.next(this.afAuth.auth.currentUser.providerData[0].uid)
      $('.popup-chat-responsive').toggleClass('open-chat');
    }
  }
  onSubmit(event: KeyboardEvent, textarea:HTMLInputElement){
    var timestamp = new Date().getTime();
    var date = new Date();
    if(event.keyCode === 13){
      var message = {
        message: textarea.value,
        sender_id: this.afAuth.auth.currentUser.providerData[0].uid,
        reciver_id: this.selectedChat,
        time: timestamp,
        date: date
      }

      // Add a new document in collection "cities"
      this.afs.collection("messages").add(message)
      .then(function() {
        console.log("Document successfully written!");
      })
      .catch(function(error) {
        console.error("Error writing document: ", error);
      });
     
    }
  }
}
