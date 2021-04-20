import { TestBed } from '@angular/core/testing';

import { UsercolorService } from './usercolor.service';

describe('UsercolorService', () => {
  let service: UsercolorService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(UsercolorService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
