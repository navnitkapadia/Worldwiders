import { AuthService } from './../login/auth.service';
import { AngularFirestore } from 'angularfire2/firestore';
import { ChatService } from './chat.service';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-messanger',
  templateUrl: './messanger.component.html',
  styleUrls: ['./messanger.component.css']
})
export class MessangerComponent implements OnInit {
  conversationDocs:any = [];
  constructor(public chatservice: ChatService, private afs: AngularFirestore, public auth: AuthService) {
    
  }

  ngOnInit() {
    this.afs.collection("users").ref.get().then(function(querySnapshot) {
      querySnapshot.forEach(function(doc) {
          // doc.data() is never undefined for query doc snapshots 
          console.log(doc.id, " => ", doc.data());
      });
    });
  }
}
