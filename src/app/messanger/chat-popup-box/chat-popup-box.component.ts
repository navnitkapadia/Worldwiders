import { Component, OnInit, OnChanges, Input, SimpleChanges } from '@angular/core';
import { Subject } from 'rxjs/Subject';
import { AngularFirestore } from 'angularfire2/firestore';
import { AngularFireAuth } from 'angularfire2/auth';
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
  senderId$ = new Subject<string>();
  reciverId$ = new Subject<string>();
  constructor(private afs: AngularFirestore, private afAuth: AngularFireAuth) { 
    const queryObservable = this.senderId$.switchMap(id =>
      afs.collection('messages', ref => ref.where('sender_id', '==', id)).valueChanges());
    queryObservable.subscribe(queriedItems => {
      console.log(queriedItems);  
    });
  }

  ngOnInit() {
    
  }
  ngOnChanges(changes: SimpleChanges) {
    if(this.selectedChat){
      this.senderId$.next(this.selectedChat);
      this.reciverId$.next(this.afAuth.auth.currentUser.providerData[0].uid)
      $('.popup-chat-responsive').toggleClass('open-chat');
    }
  }
}
