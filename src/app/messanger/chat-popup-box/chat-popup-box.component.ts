import { Component, OnInit, OnChanges, Input, SimpleChanges } from '@angular/core';
declare var $:any;
@Component({
  selector: 'app-chat-popup-box',
  templateUrl: './chat-popup-box.component.html',
  styleUrls: ['./chat-popup-box.component.css']
})
export class ChatPopupBoxComponent implements OnInit, OnChanges {
  @Input() selectedChat: String;
  @Input() isOpened:boolean;
  
  constructor() { }

  ngOnInit() {
    
  }
  ngOnChanges(changes: SimpleChanges) {
    console.log(this.selectedChat);
    console.log(this.isOpened);
    if(this.selectedChat){
      $('.popup-chat-responsive').toggleClass('open-chat');
    }
  }
}
