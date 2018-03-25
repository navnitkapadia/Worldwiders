import {  AngularFirestore, AngularFirestoreCollection } from 'angularfire2/firestore';
import { Component, OnInit } from '@angular/core';
import { Observable } from 'rxjs/Observable';

export interface Item { name: string; }
declare var $:any;
@Component({
  selector: 'app-sidebar-right',
  templateUrl: './sidebar-right.component.html',
  styleUrls: ['./sidebar-right.component.css']
})
export class SidebarRightComponent implements OnInit {
  private onlineUsersCollection: AngularFirestoreCollection<Item>;
  users: Observable<Item[]>;
  constructor(private afs: AngularFirestore) {
    this.onlineUsersCollection = afs.collection<Item>('users');
    this.users = this.onlineUsersCollection.valueChanges();
   }

  ngOnInit() {
  }
  openChat(id){
    console.log('chat opened',id);
  }
}
