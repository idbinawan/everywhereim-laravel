import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { UsercolorService } from 'src/app/services/usercolor.service';

@Component({
  selector: 'app-color-edit',
  templateUrl: './color-edit.component.html',
  styleUrls: ['./color-edit.component.css']
})
export class ColorEditComponent implements OnInit {

  colors:any;
  user:any;
  currentUserColorId = 0;
  currentUserId = 0;
  deletable = false;

  constructor(private usercolorService: UsercolorService, private route:ActivatedRoute) { }

  ngOnInit(): void {
    this.retrieveColors();
    this.route.queryParams.subscribe(
      params => {
        this.currentUserColorId = params['usercolor_id'];
        this.currentUserId = params['user_id'];
      }
    )
    if (this.currentUserColorId > 0) {
      this.usercolorService.getUserColor(this.currentUserId)
        .subscribe(
          data => {
            this.deletable = data.colors.length > 1;
            console.log(data.colors.length);
          },
          error => {
            console.log(error);
        });
    }
  }

  retrieveColors(): void {
    this.usercolorService.getAllColors()
      .subscribe(
        data => {
          this.colors = data;
        },
        error => {
          console.log(error);
        });
  }

  editColor(color_id): void {
    if (this.currentUserColorId) {
      this.updateColor(color_id);
    } else {
      this.addColor(color_id);
    }
  }

  updateColor(color_id): void {
    const data = {
      color_id: color_id
    };
    this.usercolorService.updateColorSelection(this.currentUserColorId, data)
      .subscribe(
        response => {
          window.location.href = '#';
        },
        error => {
          console.log(error);
        });
  }

  addColor(color_id): void {
    const data = {
      user_id: this.currentUserId,
      color_id: color_id
    };
    console.log(data);
    this.usercolorService.addColorToUser(data)
      .subscribe(
        response => {
          window.location.href = '#';
        },
        error => {
          console.log(error);
        });
  }

  deleteColor(): void {
    this.usercolorService.deleteUserColor(this.currentUserColorId)
      .subscribe(
        response => {
          window.location.href = '#';
        },
        error => {
          console.log(error);
        });
  }
}
