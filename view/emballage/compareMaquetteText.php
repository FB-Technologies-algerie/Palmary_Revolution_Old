<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
      integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
      integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.4.3/cropper.min.css"
    />

    <title>Comparaison deux maquettes</title>
    <link type="image/x-icon" href="<?= $_SESSION['url'] ?>public/img/faviconPalmary.ico" rel="shortcut icon">
  </head>
  <body>
    <style>
      img {
        max-width: 100%; /* This rule is very important, please do not ignore this! */
      }

      .txtTitle {
        font-size: 25px;
        font-weight: bold;
      }
      #ocrStep {
        display: none;
      }
      #resultStep {
        display: none;
      }
      del {
        text-decoration: none;
        color: #b30000;
        background: #fadad7;
      }
      ins {
        background: #eaf2c2;
        color: #406619;
        text-decoration: none;
      }
    </style>
    <div class="container">
      <div class="row">
        <div class="col-lg">
          <p class="text-center txtTitle">
            Selectionner la première image à analyser
          </p>
          <div class="custom-file m-3" id="selectFile">
            <input
              type="file"
              class="custom-file-input"
              accept="image/*"
              id="validatedCustomFile"
              onchange="openFile(event,1)"
              required
            />
            <label class="custom-file-label" for="validatedCustomFile"
              >Choisir une image...</label
            >
          </div>
          <div id="cropper" style="display:none">
            <div style="margin-top:100px">
              <div class="text-center">
                <button class="btn btn-primary" onclick="rotate(-45,1)">
                  <i class="fas fa-undo"></i>
                </button>
                <button class="btn btn-primary" onclick="rotate(45,1)">
                  <i class="fas fa-redo"></i>
                </button>
                <button class="btn btn-primary" onclick="zoom(0.1,1)">
                  <i class="fas fa-search-plus"></i>
                </button>
                <button class="btn btn-primary" onclick="zoom(-0.1,1)">
                  <i class="fas fa-search-minus"></i>
                </button>
                <button class="btn btn-primary" onclick="move(10,0,1)">
                  <i class="fas fa-arrow-right"></i>
                </button>
                <button class="btn btn-primary" onclick="move(-10,0,1)">
                  <i class="fas fa-arrow-left"></i>
                </button>
                <button class="btn btn-primary" onclick="move(0,10,1)">
                  <i class="fas fa-arrow-down"></i>
                </button>
                <button class="btn btn-primary" onclick="move(0,-10,1)">
                  <i class="fas fa-arrow-up"></i>
                </button>
              </div>
            </div>

            <img id="output" src="" />
          </div>
        </div>
        <div class="col-lg">
          <p class="text-center txtTitle">Maquette selectionné</p>
          <div style="margin-top:100px">
            <div class="text-center">
              <button class="btn btn-primary" onclick="rotate(-45,2)">
                <i class="fas fa-undo"></i>
              </button>
              <button class="btn btn-primary" onclick="rotate(45,2)">
                <i class="fas fa-redo"></i>
              </button>
              <button class="btn btn-primary" onclick="zoom(0.1,2)">
                <i class="fas fa-search-plus"></i>
              </button>
              <button class="btn btn-primary" onclick="zoom(-0.1,2)">
                <i class="fas fa-search-minus"></i>
              </button>
              <button class="btn btn-primary" onclick="move(10,0,2)">
                <i class="fas fa-arrow-right"></i>
              </button>
              <button class="btn btn-primary" onclick="move(-10,0,2)">
                <i class="fas fa-arrow-left"></i>
              </button>
              <button class="btn btn-primary" onclick="move(0,10,2)">
                <i class="fas fa-arrow-down"></i>
              </button>
              <button class="btn btn-primary" onclick="move(0,-10,2)">
                <i class="fas fa-arrow-up"></i>
              </button>
            </div>

            <img id="output2" src="<?= $_SESSION['url'].'afficheMaquette/'.$image ?>" />
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg text-center">
          <button
            id="validBtn"
            class="btn btn-primary m-3 mx-auto"
            onclick="getimage(this)"
            style="display:none"
          >
            Valider l'image
          </button>
        </div>
      </div>

      <div id="ocrStep">
        <p class="text-center txtTitle">les deux images rogné</p>
        <div class="row">
          <div class="col"><img id="outputCropped" src="" alt="" /></div>
          <div class="col"><img id="outputCropped2" src="" alt="" /></div>
        </div>

        <button
          id="validOcrBtn"
          class="btn btn-primary m-3 mx-auto d-block"
          onclick="ocr(this)"
        >
          Lancer l'OCR
        </button>
        <div class="row">
          <div class="col">
            <div class="progress">
              <div
                class="progress-bar loader"
                role="progressbar"
                style="width: 0%;"
                aria-valuenow="0"
                aria-valuemin="0"
                aria-valuemax="100"
              ></div>
            </div>
          </div>
          <div class="col">
            <div class="progress">
              <div
                class="progress-bar loader2"
                role="progressbar"
                style="width: 0%;"
                aria-valuenow="0"
                aria-valuemin="0"
                aria-valuemax="100"
              ></div>
            </div>
          </div>
        </div>
      </div>
      <div id="resultStep">
        <p class="text-center txtTitle m-3">Le texte</p>
        <div class="row">
          <div class="col"><textarea id="a" class="w-100"></textarea></div>
          <div class="col"><textarea id="b" class="w-100"></textarea></div>
        </div>
        <p class="text-center txtTitle m-3">Comparaison</p>
        <div class="row">
          <div class="col"><div id="result"></div></div>
        </div>
      </div>
    </div>
      </div>

    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
      integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
      integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
      crossorigin="anonymous"
    ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.4.3/cropper.min.js"></script>
    <script src="<?= $_SESSION['url'] ?>public/js/node_modules/tesseract.js/dist/tesseract.js"></script>
    <script src="<?= $_SESSION['url'] ?>public/js/node_modules/tesseract.js/dist/worker.js"></script>

    <script>
      var output;
      var output2 = document.getElementById("output2");
      cropper2 = new Cropper(output2);
      var outputCropped;
      var outputCropped2;
      function openFile(event, index) {
        output = document.getElementById("output");
        output.src = URL.createObjectURL(event.target.files[0]);
        cropper = new Cropper(output);
        document.getElementById("cropper").style.display = "block";
        document.getElementById("selectFile").style.display = "none";
        document.getElementById('validBtn').style.display = "block"
      }

      function rotate(val, index) {
        if (index == 1) {
          cropper.rotate(val);
        } else {
          cropper2.rotate(val);
        }
      }

      function zoom(val, index) {
        if (index == 1) {
          cropper.zoom(val);
        } else {
          cropper2.zoom(val);
        }
      }

      function getimage(val) {
        val.disabled = true;
        console.log(cropper);
        outputCropped = document.getElementById("outputCropped");
        outputCropped2 = document.getElementById("outputCropped2");

        outputCropped.setAttribute(
          "src",
          cropper.getCroppedCanvas().toDataURL("image/jpeg")
        );
        outputCropped2.setAttribute(
          "src",
          cropper2.getCroppedCanvas().toDataURL("image/jpeg")
        );
        document.getElementById("ocrStep").style.display = "block";
      }

      function move(val1, val2, index) {
        if (index == 1) {
          cropper.move(val1, val2);
        } else {
          cropper2.move(val1, val2);
        }
      }
      function ocr(val) {
        val.disabled = true;

        window.Tesseract1 = Tesseract.recognize(outputCropped, "fra")
          .progress(function(p) {
            document.querySelector(".loader").style.width =
              Math.round(p.progress * 100) + "%";
            document.querySelector(".loader").textContent =
              p.status + " " + Math.round(p.progress * 100) + "%";
          })
          .finally(result => {
            console.log("deuxième");
            console.log(result);
            document.querySelector("#a").textContent = result.text;
            window.Tesseract2 = Tesseract.recognize(outputCropped2, "fra")
              .progress(function(p) {
                document.querySelector(".loader2").style.width =
                  Math.round(p.progress * 100) + "%";
                document.querySelector(".loader2").textContent =
                  p.status + " " + Math.round(p.progress * 100) + "%";
              })
              .finally(result => {
                document.querySelector("#b").textContent = result.text;
                document.getElementById("resultStep").style.display = "block";
                check();
              });
          });

        /*
              val.disabled = true;
              console.log("première");
              window.Tesseract1 = Tesseract.recognize(outputCropped, "fra")
                .progress(function(p) {
                  console.log("progress", p);
                  document.querySelector(".progress-bar").style.width =
                    Math.round(p.progress * 100) + "%";
                  document.querySelector(".progress-bar").textContent =
                    p.status + " " + Math.round(p.progress * 100) + "%";
                })
                .then(function(result) {
                  document.getElementById("resultStep").style.display = "block";
                  console.log("result", result);
                  document.getElementById("result").textContent = result.text;
                });
              /*  window.Tesseract1 = Tesseract.recognize(dataURL1, "fra").progress(
                function(p) {
                  document.querySelector(".loader1").style.width =
                    Math.round(p.progress * 100) + "%";
                }
              );*/
      }
    </script>

    <script>
      var JsDiff = (function() {
        /*jshint maxparams: 5*/
        function clonePath(path) {
          return {
            newPos: path.newPos,
            components: path.components.slice(0)
          };
        }

        function removeEmpty(array) {
          var ret = [];
          for (var i = 0; i < array.length; i++) {
            if (array[i]) {
              ret.push(array[i]);
            }
          }
          return ret;
        }

        function escapeHTML(s) {
          var n = s;
          n = n.replace(/&/g, "&amp;");
          n = n.replace(/</g, "&lt;");
          n = n.replace(/>/g, "&gt;");
          n = n.replace(/"/g, "&quot;");

          return n;
        }

        var Diff = function(ignoreWhitespace) {
          this.ignoreWhitespace = ignoreWhitespace;
        };
        Diff.prototype = {
          diff: function(oldString, newString) {
            // Handle the identity case (this is due to unrolling editLength == 0
            if (newString === oldString) {
              return [
                {
                  value: newString
                }
              ];
            }
            if (!newString) {
              return [
                {
                  value: oldString,
                  removed: true
                }
              ];
            }
            if (!oldString) {
              return [
                {
                  value: newString,
                  added: true
                }
              ];
            }

            newString = this.tokenize(newString);
            oldString = this.tokenize(oldString);

            var newLen = newString.length,
              oldLen = oldString.length;
            var maxEditLength = newLen + oldLen;
            var bestPath = [
              {
                newPos: -1,
                components: []
              }
            ];

            // Seed editLength = 0
            var oldPos = this.extractCommon(
              bestPath[0],
              newString,
              oldString,
              0
            );
            if (bestPath[0].newPos + 1 >= newLen && oldPos + 1 >= oldLen) {
              return bestPath[0].components;
            }

            for (
              var editLength = 1;
              editLength <= maxEditLength;
              editLength++
            ) {
              for (
                var diagonalPath = -1 * editLength;
                diagonalPath <= editLength;
                diagonalPath += 2
              ) {
                var basePath;
                var addPath = bestPath[diagonalPath - 1],
                  removePath = bestPath[diagonalPath + 1];
                oldPos = (removePath ? removePath.newPos : 0) - diagonalPath;
                if (addPath) {
                  // No one else is going to attempt to use this value, clear it
                  bestPath[diagonalPath - 1] = undefined;
                }

                var canAdd = addPath && addPath.newPos + 1 < newLen;
                var canRemove = removePath && 0 <= oldPos && oldPos < oldLen;
                if (!canAdd && !canRemove) {
                  bestPath[diagonalPath] = undefined;
                  continue;
                }

                // Select the diagonal that we want to branch from. We select the prior
                // path whose position in the new string is the farthest from the origin
                // and does not pass the bounds of the diff graph
                if (
                  !canAdd ||
                  (canRemove && addPath.newPos < removePath.newPos)
                ) {
                  basePath = clonePath(removePath);
                  this.pushComponent(
                    basePath.components,
                    oldString[oldPos],
                    undefined,
                    true
                  );
                } else {
                  basePath = clonePath(addPath);
                  basePath.newPos++;
                  this.pushComponent(
                    basePath.components,
                    newString[basePath.newPos],
                    true,
                    undefined
                  );
                }

                var oldPos = this.extractCommon(
                  basePath,
                  newString,
                  oldString,
                  diagonalPath
                );

                if (basePath.newPos + 1 >= newLen && oldPos + 1 >= oldLen) {
                  return basePath.components;
                } else {
                  bestPath[diagonalPath] = basePath;
                }
              }
            }
          },

          pushComponent: function(components, value, added, removed) {
            var last = components[components.length - 1];
            if (last && last.added === added && last.removed === removed) {
              // We need to clone here as the component clone operation is just
              // as shallow array clone
              components[components.length - 1] = {
                value: this.join(last.value, value),
                added: added,
                removed: removed
              };
            } else {
              components.push({
                value: value,
                added: added,
                removed: removed
              });
            }
          },
          extractCommon: function(
            basePath,
            newString,
            oldString,
            diagonalPath
          ) {
            var newLen = newString.length,
              oldLen = oldString.length,
              newPos = basePath.newPos,
              oldPos = newPos - diagonalPath;
            while (
              newPos + 1 < newLen &&
              oldPos + 1 < oldLen &&
              this.equals(newString[newPos + 1], oldString[oldPos + 1])
            ) {
              newPos++;
              oldPos++;

              this.pushComponent(
                basePath.components,
                newString[newPos],
                undefined,
                undefined
              );
            }
            basePath.newPos = newPos;
            return oldPos;
          },

          equals: function(left, right) {
            var reWhitespace = /\S/;
            if (
              this.ignoreWhitespace &&
              !reWhitespace.test(left) &&
              !reWhitespace.test(right)
            ) {
              return true;
            } else {
              return left === right;
            }
          },
          join: function(left, right) {
            return left + right;
          },
          tokenize: function(value) {
            return value;
          }
        };

        var CharDiff = new Diff();

        var WordDiff = new Diff(true);
        WordDiff.tokenize = function(value) {
          return removeEmpty(value.split(/(\s+|\b)/));
        };

        var CssDiff = new Diff(true);
        CssDiff.tokenize = function(value) {
          return removeEmpty(value.split(/([{}:;,]|\s+)/));
        };

        var LineDiff = new Diff();
        LineDiff.tokenize = function(value) {
          return value.split(/^/m);
        };

        return {
          Diff: Diff,

          diffChars: function(oldStr, newStr) {
            return CharDiff.diff(oldStr, newStr);
          },
          diffWords: function(oldStr, newStr) {
            return WordDiff.diff(oldStr, newStr);
          },
          diffLines: function(oldStr, newStr) {
            return LineDiff.diff(oldStr, newStr);
          },

          diffCss: function(oldStr, newStr) {
            return CssDiff.diff(oldStr, newStr);
          },

          createPatch: function(
            fileName,
            oldStr,
            newStr,
            oldHeader,
            newHeader
          ) {
            var ret = [];

            ret.push("Index: " + fileName);
            ret.push(
              "==================================================================="
            );
            ret.push(
              "--- " +
                fileName +
                (typeof oldHeader === "undefined" ? "" : "\t" + oldHeader)
            );
            ret.push(
              "+++ " +
                fileName +
                (typeof newHeader === "undefined" ? "" : "\t" + newHeader)
            );

            var diff = LineDiff.diff(oldStr, newStr);
            if (!diff[diff.length - 1].value) {
              diff.pop(); // Remove trailing newline add
            }
            diff.push({
              value: "",
              lines: []
            }); // Append an empty value to make cleanup easier

            function contextLines(lines) {
              return lines.map(function(entry) {
                return " " + entry;
              });
            }

            function eofNL(curRange, i, current) {
              var last = diff[diff.length - 2],
                isLast = i === diff.length - 2,
                isLastOfType =
                  i === diff.length - 3 &&
                  (current.added !== last.added ||
                    current.removed !== last.removed);

              // Figure out if this is the last line for the given file and missing NL
              if (!/\n$/.test(current.value) && (isLast || isLastOfType)) {
                curRange.push("\\ No newline at end of file");
              }
            }

            var oldRangeStart = 0,
              newRangeStart = 0,
              curRange = [],
              oldLine = 1,
              newLine = 1;
            for (var i = 0; i < diff.length; i++) {
              var current = diff[i],
                lines =
                  current.lines || current.value.replace(/\n$/, "").split("\n");
              current.lines = lines;

              if (current.added || current.removed) {
                if (!oldRangeStart) {
                  var prev = diff[i - 1];
                  oldRangeStart = oldLine;
                  newRangeStart = newLine;

                  if (prev) {
                    curRange = contextLines(prev.lines.slice(-4));
                    oldRangeStart -= curRange.length;
                    newRangeStart -= curRange.length;
                  }
                }
                curRange.push.apply(
                  curRange,
                  lines.map(function(entry) {
                    return (current.added ? "+" : "-") + entry;
                  })
                );
                eofNL(curRange, i, current);

                if (current.added) {
                  newLine += lines.length;
                } else {
                  oldLine += lines.length;
                }
              } else {
                if (oldRangeStart) {
                  // Close out any changes that have been output (or join overlapping)
                  if (lines.length <= 8 && i < diff.length - 2) {
                    // Overlapping
                    curRange.push.apply(curRange, contextLines(lines));
                  } else {
                    // end the range and output
                    var contextSize = Math.min(lines.length, 4);
                    ret.push(
                      "@@ -" +
                        oldRangeStart +
                        "," +
                        (oldLine - oldRangeStart + contextSize) +
                        " +" +
                        newRangeStart +
                        "," +
                        (newLine - newRangeStart + contextSize) +
                        " @@"
                    );
                    ret.push.apply(ret, curRange);
                    ret.push.apply(
                      ret,
                      contextLines(lines.slice(0, contextSize))
                    );
                    if (lines.length <= 4) {
                      eofNL(ret, i, current);
                    }

                    oldRangeStart = 0;
                    newRangeStart = 0;
                    curRange = [];
                  }
                }
                oldLine += lines.length;
                newLine += lines.length;
              }
            }

            return ret.join("\n") + "\n";
          },

          applyPatch: function(oldStr, uniDiff) {
            var diffstr = uniDiff.split("\n");
            var diff = [];
            var remEOFNL = false,
              addEOFNL = false;

            for (
              var i = diffstr[0][0] === "I" ? 4 : 0;
              i < diffstr.length;
              i++
            ) {
              if (diffstr[i][0] === "@") {
                var meh = diffstr[i].split(/@@ -(\d+),(\d+) \+(\d+),(\d+) @@/);
                diff.unshift({
                  start: meh[3],
                  oldlength: meh[2],
                  oldlines: [],
                  newlength: meh[4],
                  newlines: []
                });
              } else if (diffstr[i][0] === "+") {
                diff[0].newlines.push(diffstr[i].substr(1));
              } else if (diffstr[i][0] === "-") {
                diff[0].oldlines.push(diffstr[i].substr(1));
              } else if (diffstr[i][0] === " ") {
                diff[0].newlines.push(diffstr[i].substr(1));
                diff[0].oldlines.push(diffstr[i].substr(1));
              } else if (diffstr[i][0] === "\\") {
                if (diffstr[i - 1][0] === "+") {
                  remEOFNL = true;
                } else if (diffstr[i - 1][0] === "-") {
                  addEOFNL = true;
                }
              }
            }

            var str = oldStr.split("\n");
            for (var i = diff.length - 1; i >= 0; i--) {
              var d = diff[i];
              for (var j = 0; j < d.oldlength; j++) {
                if (str[d.start - 1 + j] !== d.oldlines[j]) {
                  return false;
                }
              }
              Array.prototype.splice.apply(
                str,
                [d.start - 1, +d.oldlength].concat(d.newlines)
              );
            }

            if (remEOFNL) {
              while (!str[str.length - 1]) {
                str.pop();
              }
            } else if (addEOFNL) {
              str.push("");
            }
            return str.join("\n");
          },

          convertChangesToXML: function(changes) {
            var ret = [];
            for (var i = 0; i < changes.length; i++) {
              var change = changes[i];
              if (change.added) {
                ret.push("<ins class='diff'>");
              } else if (change.removed) {
                ret.push("<del class='diff'>");
              }

              ret.push(escapeHTML(change.value));

              if (change.added) {
                ret.push("</ins>");
              } else if (change.removed) {
                ret.push("</del>");
              }
            }
            return ret.join("");
          },

          // See: http://code.google.com/p/google-diff-match-patch/wiki/API
          convertChangesToDMP: function(changes) {
            var ret = [],
              change;
            for (var i = 0; i < changes.length; i++) {
              change = changes[i];
              ret.push([
                change.added ? 1 : change.removed ? -1 : 0,
                change.value
              ]);
            }
            return ret;
          }
        };
      })();

      if (typeof module !== "undefined") {
        module.exports = JsDiff;
      }

      var a = document.getElementById("a");
      var b = document.getElementById("b");
      var result = document.getElementById("result");
      var diffType = "diffChars";

      function check() {
        var oldStr = a.value;
        var newStr = b.value;
        var changes = JsDiff[diffType](oldStr, newStr);
        console.log(changes);
        result.innerHTML = JsDiff.convertChangesToXML(changes);
      }

      a.onkeyup = b.onkeyup = a.onpaste = a.onchange = b.onpaste = b.onchange = check;
      check();

      var radio = document.getElementsByName("diff_type");
      for (var i = 0; i < radio.length; i++) {
        radio[i].onchange = function(e) {
          diffType = this.value;
          check();
        };
      }
    </script>
  </body>
</html>
