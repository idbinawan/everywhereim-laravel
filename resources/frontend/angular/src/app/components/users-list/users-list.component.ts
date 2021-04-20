import { Component, OnInit } from '@angular/core';
import { UsercolorService } from 'src/app/services/usercolor.service';

@Component({
  selector: 'app-users-list',
  templateUrl: './users-list.component.html',
  styleUrls: ['./users-list.component.css']
})
export class UsersListComponent implements OnInit {

  users: any;

  constructor(private usercolorService: UsercolorService) { }

  ngOnInit(): void {
    this.retrieveUsers();
  }

  retrieveUsers(): void {
    this.usercolorService.getAllUsers()
      .subscribe(
        data => {
          this.users = data;
        },
        error => {
          console.log(error);
        });
  }

  editColor(user_id, usercolor_id): void {
    window.location.href = 'color?do=edit&user_id='+user_id+'&usercolor_id='+usercolor_id;
  }

  addColor(user_id): void {
    window.location.href = 'color?do=add&user_id='+user_id;
  }

  refreshList(): void {
    this.retrieveUsers();
  }
}
