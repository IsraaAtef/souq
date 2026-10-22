<div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ old('name',$product->name) }}"/>
                      </div>
                      <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea  id="description" name="description" cols="" rows="" class="form-control" aria-label="With textarea">{{ old('description',$product->description) }}</textarea>
                      </div>
                      <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" name="price" class="form-control" id="price" value="{{ old('price',$product->price) }}"/>
                      </div>
                      <div class="mb-3">
                        <label for="store_id" class="form-label">Store_id</label>
                        <input type="number" name="store_id" class="form-control" id="store_id" value="{{ old('store_id',$product->store_id) }}" />
                      </div>
                      <div class="mb-3">
                        <label for="category_id" class="form-label">Category_id</label>
                        <input type="number" name="category_id" class="form-control" id="category_id" value="{{ old('category_id',$product->category_id) }}"/>
                      </div>
