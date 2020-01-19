/*
 * Project: Optimize Undo Redo
 * Copyright: 2017-2017, Jakir Hossen (contact@jshossen.com) and Shohidul Islam (theshohidul@gmail.com)
 * Version: 1.0
 * Author: Jakir And Shohidul
 */

//Initial easyUndoRedo() with some options paramiter. 
// var UndoRedo = new easyUndoRedo({
//     stackLength : 20, 
//     initialValue : "Your initial data";
// });

// UndoRedo.save("Your updated data");
// UndoRedo.undo(); //returns undo result
// UndoRedo.redo(); //returns redo result

var easyUndoRedo = function(options) {
	var settings = options ? options : {};
	var undoRedoFlag =0 ;
	var defaultOptions = {
		stackLength: 20 ,
		initialValue:'null'
	};
	
	this.stackLength = (typeof settings.stackLength != 'undefined') ? settings.stackLength : defaultOptions.stackLength;
	this.initialValue = (typeof settings.initialValue != 'undefined') ? settings.initialValue : defaultOptions.initialValue;
	var undoRedoStack = new Array ();
	undoRedoStack.push (this.initialValue);
	
	this.undo = function () {
		if ( undoRedoFlag >0 ) {
			undoRedoFlag--;
			return undoRedoStack[undoRedoFlag] ;
		}else {
			//alert ("Undo last limit reached");
			return undoRedoStack[undoRedoFlag];
		}
	}
	this.redo = function () {
		if ( undoRedoFlag == undoRedoStack.length-1 ) {
			//alert ("Redo last limit reached");
			return undoRedoStack[undoRedoFlag];
		}else {
			undoRedoFlag++;
			return undoRedoStack[undoRedoFlag];
		}
	}
	this.save = function (value) {
        if (  undoRedoFlag < undoRedoStack.length-1 ) {
            undoRedoStack.splice( undoRedoFlag+1 , undoRedoStack.length-1);
            undoRedoFlag++;
            undoRedoStack.push (value);
        }else {
            if(this.stackLength >= undoRedoStack.length){
                undoRedoFlag++;
                undoRedoStack.push (value);
            }else{
                undoRedoStack.shift();
                undoRedoStack.push (value);
            }
        }
    }
};