                      <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input
                          type="text"
                          name="name"
                          class="form-control"
                          id="name"
                          value="{{ old('name',$category->name) }}"
                        />
                      </div>
                      <div class="mb-3">
                        <label for="image_path" class="form-label">Image</label>
                        <input
                          type="file"
                          name="image_path"
                          class="form-control"
                          id="image_path"
                          accept=".jpg,.png"
                          value="{{ old('image_path',$category->image_path) }}"
                        />
                        @if($category->image_path)
                            <img src="{{ $category->image_url  }}" height="100" alt="$category->name">
                        @endif
                      </div>
                      <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea  id="description" name="description" cols="" rows="" class="form-control" area-label="With textarea">{{ old('description',$category->description) }}</textarea>
                      </div>
                      <div class="mb-3 form-check">
                        <input type="checkbox" name="is_active" {{ old('description',$category->is_active) ? 'checked': '' }} class="form-check-input" id="is_active"/>
                        <label class="form-check-label" for="is_active">Active</label>
                      </div>
