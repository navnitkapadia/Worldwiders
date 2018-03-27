import { Component, OnInit, Output, EventEmitter } from '@angular/core';
import { AuthService } from '../login/auth.service';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {
  @Output() selectedChat: string;
  @Output() isOpened: Boolean;
  constructor(public auth: AuthService) { }

  ngOnInit() {
    
  }
}