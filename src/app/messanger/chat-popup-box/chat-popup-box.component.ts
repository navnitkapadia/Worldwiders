import { Component, OnInit, OnChanges, Input, SimpleChanges } from '@angular/core';
declare var $:any;
@Component({
  selector: 'app-chat-popup-box',
  templateUrl: './chat-popup-box.component.html',
  styleUrls: ['./chat-popup-box.component.css']
})
export class ChatPopupBoxComponent implements OnInit, OnChanges {
  @Input() selectedChat: String;
  isClassVisible:boolean =  false;
  constructor() { }

  ngOnInit() {
    
  }
  ngOnChanges(changes: SimpleChanges) {
    // console.log(this.selectedChat);
    if(this.selectedChat){
      $('.popup-chat-responsive').toggleClass('open-chat');
    }
    // console.log(this.isClassVisible);
  }
}
